<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with(['hotel', 'tipeKamars'])
            ->where('is_active', true)
            ->paginate(12);

        return view('properties.index', compact('properties'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Load property dengan semua relasi yang diperlukan
        $property = Property::with([
            'hotel',
            'tipeKamars' => function($query) {
                $query->where('stok_kamar', '>', 0)
                      ->orderBy('harga', 'asc');
            },
            'tipeKamars.kamars' => function($query) {
                $query->where('status', 'tersedia');
            },
            'reviews.user'
        ])->findOrFail($id);

        // Ambil tipe kamars
        $tipeKamars = $property->tipeKamars;

        // Hitung statistik
        $averageRating = $property->reviews()->avg('star') ?? 0;
        $totalReviews = $property->reviews()->count();
        $minPrice = $tipeKamars->min('harga') ?? 0;

        // Ambil data pencarian dari session atau default
        $searchData = session('search_data', [
            'city' => $property->city,
            'checkin' => now()->format('Y-m-d'),
            'checkout' => now()->addDay()->format('Y-m-d'),
            'rooms' => 1,
            'guests' => 2,
        ]);

        return view('property.show', compact(
            'property',
            'tipeKamars',
            'averageRating',
            'totalReviews',
            'minPrice',
            'searchData'
        ));
    }

    /**
     * Search properties
     */
    public function search(Request $request)
{
    $validated = $request->validate([
        'search' => 'nullable|string',
        'checkin' => 'nullable|date|after_or_equal:today',
        'checkout' => 'nullable|date|after:checkin',
        'total_rooms' => 'nullable|integer|min:1',
        'total_guests' => 'nullable|integer|min:1',
    ]);

    $query = Property::with(['hotel', 'tipeKamars'])
        ->where('is_active', true);

    // Filter by search term (city, area, property name, or hotel name)
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('city', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
              ->orWhereHas('hotel', function($hotelQuery) use ($searchTerm) {
                  $hotelQuery->where('nama', 'LIKE', '%' . $searchTerm . '%');
              });
        });
    }

    // Filter by guest capacity (berdasarkan kapasitas tipe kamar)
    if ($request->filled('total_guests')) {
        $query->whereHas('tipeKamars', function($q) use ($request) {
            $q->where('kapasitas', '>=', $request->total_guests);
        });
    }

    // Filter by available rooms based on check-in/check-out dates
    if ($request->filled('checkin') && $request->filled('checkout')) {
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        $totalRoomsNeeded = $request->filled('total_rooms') ? $request->total_rooms : 1;

        // Hanya tampilkan property yang memiliki kamar kosong di tanggal tersebut
        $query->whereHas('tipeKamars.kamars', function($kamarQuery) use ($checkin, $checkout) {
            // Kamar dengan status tersedia
            $kamarQuery->where('status', 'tersedia')
                // Dan TIDAK memiliki booking yang overlap dengan tanggal yang dicari
                ->whereDoesntHave('bookings', function($bookingQuery) use ($checkin, $checkout) {
                    $bookingQuery->whereNotIn('status', ['cancelled', 'completed'])
                        ->where(function($dateQuery) use ($checkin, $checkout) {
                            // Cek overlap:
                            // Booking overlap jika:
                            // - checkin_date booking <= checkout pencarian DAN
                            // - checkout_date booking >= checkin pencarian
                            $dateQuery->where('checkin_date', '<=', $checkout)
                                      ->where('checkout_date', '>=', $checkin);
                        });
                });
        });

        // Pastikan ada minimal sejumlah kamar yang dibutuhkan
        if ($totalRoomsNeeded > 1) {
            $query->where(function($q) use ($checkin, $checkout, $totalRoomsNeeded) {
                $q->whereHas('tipeKamars', function($tipeQuery) use ($checkin, $checkout, $totalRoomsNeeded) {
                    // Hitung kamar yang tersedia (tidak dibooking)
                    $tipeQuery->whereRaw('(
                        SELECT COUNT(k.id)
                        FROM kamars k
                        WHERE k.tipe_kamar_id = tipe_kamars.id
                        AND k.status = "tersedia"
                        AND k.id NOT IN (
                            SELECT DISTINCT b.kamar_id
                            FROM bookings b
                            WHERE b.kamar_id = k.id
                            AND b.status NOT IN ("cancelled", "completed")
                            AND b.checkin_date <= ?
                            AND b.checkout_date >= ?
                        )
                    ) >= ?', [$checkout, $checkin, $totalRoomsNeeded]);
                });
            });
        }
    }

    $properties = $query->paginate(12)->appends($request->all());

    // Save search data to session
    session([
        'search_data' => [
            'search' => $request->search,
            'checkin' => $request->checkin ?? now()->format('Y-m-d'),
            'checkout' => $request->checkout ?? now()->addDay()->format('Y-m-d'),
            'total_rooms' => $request->total_rooms ?? 1,
            'total_guests' => $request->total_guests ?? 2,
        ]
    ]);

    return view('property.search', compact('properties'));
}
}
