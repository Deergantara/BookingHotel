<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TipeKamar;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Search properties dengan filter lengkap
     */
    public function search(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'checkin' => 'nullable|date|after_or_equal:today',
            'checkout' => 'nullable|date|after:checkin',
            'total_rooms' => 'nullable|integer|min:1',
            'total_guests' => 'nullable|integer|min:1',
            'min_price' => 'nullable|integer|min:0',
            'max_price' => 'nullable|integer|min:0',
            'cities' => 'nullable|array',
            'cities.*' => 'string|max:255',
            'ratings' => 'nullable|array',
            'ratings.*' => 'integer|min:1|max:5',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:255',
            'sort' => 'nullable|in:popular,price-low,price-high,rating',
        ]);

        // Query dasar
        $query = Property::with(['hotel', 'tipeKamars'])
            ->where('is_active', true);

        // Filter berdasarkan pencarian (nama, kota, area)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('city', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('area', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhere('address', 'LIKE', '%' . $searchTerm . '%')
                  ->orWhereHas('hotel', function($hotelQuery) use ($searchTerm) {
                      $hotelQuery->where('nama', 'LIKE', '%' . $searchTerm . '%');
                  });
            });
        }

        // Filter berdasarkan kota
        if ($request->filled('cities')) {
            $query->whereIn('city', $request->cities);
        }

        // Filter berdasarkan rating (bintang)
        if ($request->filled('ratings')) {
            $query->whereIn('bintang', $request->ratings);
        }

        // Filter berdasarkan fasilitas
        if ($request->filled('facilities')) {
            foreach ($request->facilities as $facility) {
                $query->where('fasilitas', 'LIKE', '%' . trim($facility) . '%');
            }
        }

        // Filter berdasarkan harga (dari tipe kamar)
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('tipeKamars', function($q) use ($request) {
                if ($request->filled('min_price')) {
                    $q->where('harga', '>=', $request->min_price);
                }
                if ($request->filled('max_price')) {
                    $q->where('harga', '<=', $request->max_price);
                }
            });
        }

        // Filter berdasarkan kapasitas tamu
        if ($request->filled('total_guests')) {
            $query->whereHas('tipeKamars', function($q) use ($request) {
                $q->where('kapasitas', '>=', $request->total_guests);
            });
        }

        // Filter berdasarkan ketersediaan kamar pada tanggal tertentu
        if ($request->filled('checkin') && $request->filled('checkout')) {
            $checkin = $request->checkin;
            $checkout = $request->checkout;
            $totalRoomsNeeded = $request->filled('total_rooms') ? $request->total_rooms : 1;

            $query->whereHas('tipeKamars.kamars', function($kamarQuery) use ($checkin, $checkout, $totalRoomsNeeded) {
                // Kamar dengan status tersedia
                $kamarQuery->where('status', 'tersedia')
                    // Dan TIDAK memiliki booking yang overlap dengan tanggal yang dicari
                    ->whereDoesntHave('bookings', function($bookingQuery) use ($checkin, $checkout) {
                        $bookingQuery->whereNotIn('status', ['cancelled', 'completed'])
                            ->where(function($dateQuery) use ($checkin, $checkout) {
                                $dateQuery->where('checkin_date', '<=', $checkout)
                                          ->where('checkout_date', '>=', $checkin);
                            });
                    });
            }, '>=', $totalRoomsNeeded);
        }

        // Sorting
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'price-low':
                $query->select('properties.*')
                    ->join('tipe_kamars', 'properties.id', '=', 'tipe_kamars.property_id')
                    ->groupBy('properties.id')
                    ->orderBy(DB::raw('MIN(tipe_kamars.harga)'), 'asc');
                break;
            case 'price-high':
                $query->select('properties.*')
                    ->join('tipe_kamars', 'properties.id', '=', 'tipe_kamars.property_id')
                    ->groupBy('properties.id')
                    ->orderBy(DB::raw('MIN(tipe_kamars.harga)'), 'desc');
                break;
            case 'rating':
                $query->orderBy('bintang', 'desc')
                      ->orderBy('created_at', 'desc');
                break;
            default: // popular
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Eksekusi query
        $properties = $query->paginate(12)->appends($request->all());

        // Simpan data pencarian ke session untuk digunakan di halaman detail
        session([
            'search_data' => [
                'search' => $request->search,
                'checkin' => $request->checkin ?? now()->format('Y-m-d'),
                'checkout' => $request->checkout ?? now()->addDay()->format('Y-m-d'),
                'total_rooms' => $request->total_rooms ?? 1,
                'total_guests' => $request->total_guests ?? 2,
            ]
        ]);

        // Data untuk filter
        $filterData = [
            'cities' => Property::where('is_active', true)
                ->distinct()
                ->pluck('city')
                ->filter()
                ->values(),
            'facilities' => Property::where('is_active', true)
                ->whereNotNull('fasilitas')
                ->pluck('fasilitas')
                ->flatMap(function($item) {
                    return explode(',', $item);
                })
                ->map(function($item) {
                    return trim($item);
                })
                ->filter()
                ->unique()
                ->values(),
            'min_price_available' => TipeKamar::min('harga') ?? 0,
            'max_price_available' => TipeKamar::max('harga') ?? 2000000,
        ];

        return view('property.search', compact('properties', 'filterData'));
    }

    /**
     * Get available facilities from database
     */
    private function getAvailableFacilities()
    {
        return Property::whereNotNull('fasilitas')
            ->pluck('fasilitas')
            ->flatMap(function($facilities) {
                return explode(',', $facilities);
            })
            ->map(function($facility) {
                return trim($facility);
            })
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Get available cities from database
     */
    private function getAvailableCities()
    {
        return Property::where('is_active', true)
            ->distinct()
            ->pluck('city')
            ->filter()
            ->values()
            ->toArray();
    }
}