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
            'city' => 'nullable|string',
            'checkin' => 'nullable|date',
            'checkout' => 'nullable|date|after:checkin',
            'rooms' => 'nullable|integer|min:1',
            'guests' => 'nullable|integer|min:1',
        ]);

        $query = Property::with(['hotel', 'tipeKamars'])
            ->where('is_active', true);

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        // Filter by capacity
        if ($request->filled('guests')) {
            $query->where('kapasitas_tamu', '>=', $request->guests);
        }

        // Filter by available rooms
        if ($request->filled('rooms')) {
            $query->whereHas('tipeKamars', function($q) use ($request) {
                $q->where('stok_kamar', '>=', $request->rooms);
            });
        }

        $properties = $query->paginate(12);

        // Save search data to session
        session([
            'search_data' => [
                'city' => $request->city,
                'checkin' => $request->checkin ?? now()->format('Y-m-d'),
                'checkout' => $request->checkout ?? now()->addDay()->format('Y-m-d'),
                'rooms' => $request->rooms ?? 1,
                'guests' => $request->guests ?? 2,
            ]
        ]);

        return view('property.search', compact('properties'));
    }
}