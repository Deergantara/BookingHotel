<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TipeKamar;
use App\Models\Review;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'reviews.user',
            'fasilitas'
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
     * Search properties dengan filter lengkap - IMPROVED VERSION
     */
    public function search(Request $request)
    {
        // ✅ Gunakan input() langsung tanpa validasi yang strict
        $searchTerm = $request->input('search');
        $selectedCities = $request->input('cities', []);
        $selectedRatings = $request->input('ratings', []);
        $selectedFacilities = $request->input('facilities', []);
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'popular');

        // ✅ DEBUG: Log request untuk troubleshooting
        Log::info('=== PROPERTY SEARCH START ===', [
            'search_term' => $searchTerm,
            'selected_facilities' => $selectedFacilities,
            'selected_cities' => $selectedCities,
            'selected_ratings' => $selectedRatings,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'sort' => $sort
        ]);

        // Query dasar
        $query = Property::with(['hotel', 'tipeKamars', 'fasilitas'])
            ->where('is_active', true);

        // Filter berdasarkan pencarian (nama, kota, area)
        if (!empty($searchTerm)) {
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
        if (!empty($selectedCities)) {
            $query->whereIn('city', $selectedCities);
        }

        // Filter berdasarkan rating (bintang)
        if (!empty($selectedRatings)) {
            $query->whereIn('bintang', $selectedRatings);
        }

        // ✅ FILTER FASILITAS - IMPROVED
        if (!empty($selectedFacilities)) {
            Log::info('Applying facilities filter', [
                'selected_facility_ids' => $selectedFacilities,
                'facilities_count' => count($selectedFacilities)
            ]);

            // OR Logic - Property memiliki minimal satu fasilitas yang dipilih
            $query->whereHas('fasilitas', function($q) use ($selectedFacilities) {
                $q->whereIn('fasilitas.id', $selectedFacilities);
            });

            // ✅ DEBUG: Cek berapa property yang match dengan filter ini
            $matchingCount = Property::whereHas('fasilitas', function($q) use ($selectedFacilities) {
                $q->whereIn('fasilitas.id', $selectedFacilities);
            })->count();

            Log::info('Properties matching facilities filter', [
                'matching_count' => $matchingCount,
                'selected_facilities' => $selectedFacilities
            ]);
        }

        // ✅ FILTER HARGA - IMPROVED VERSION
        if (!empty($minPrice) || !empty($maxPrice)) {
            Log::info('Applying price filter', [
                'min_price' => $minPrice,
                'max_price' => $maxPrice
            ]);

            // Gunakan subquery untuk mendapatkan harga terendah setiap property
            $query->whereHas('tipeKamars', function($q) use ($minPrice, $maxPrice) {
                // Jika hanya min_price yang diisi
                if (!empty($minPrice) && empty($maxPrice)) {
                    $q->where('harga', '>=', $minPrice);
                }
                // Jika hanya max_price yang diisi
                elseif (empty($minPrice) && !empty($maxPrice)) {
                    $q->where('harga', '<=', $maxPrice);
                }
                // Jika kedua-duanya diisi
                elseif (!empty($minPrice) && !empty($maxPrice)) {
                    $q->whereBetween('harga', [$minPrice, $maxPrice]);
                }
            });

            // ✅ DEBUG: Hitung property yang match dengan filter harga
            $priceMatchingCount = Property::whereHas('tipeKamars', function($q) use ($minPrice, $maxPrice) {
                if (!empty($minPrice) && empty($maxPrice)) {
                    $q->where('harga', '>=', $minPrice);
                }
                elseif (empty($minPrice) && !empty($maxPrice)) {
                    $q->where('harga', '<=', $maxPrice);
                }
                elseif (!empty($minPrice) && !empty($maxPrice)) {
                    $q->whereBetween('harga', [$minPrice, $maxPrice]);
                }
            })->count();

            Log::info('Properties matching price filter', [
                'price_matching_count' => $priceMatchingCount,
                'min_price' => $minPrice,
                'max_price' => $maxPrice
            ]);
        }

        // Sorting
        switch ($sort) {
            case 'price-low':
                // Sorting berdasarkan harga terendah dari tipe kamar
                $query->select('properties.*')
                    ->join('tipe_kamars', 'properties.id', '=', 'tipe_kamars.property_id')
                    ->groupBy('properties.id')
                    ->orderBy(DB::raw('MIN(tipe_kamars.harga)'), 'asc');
                break;
            case 'price-high':
                // Sorting berdasarkan harga tertinggi dari tipe kamar
                $query->select('properties.*')
                    ->join('tipe_kamars', 'properties.id', '=', 'tipe_kamars.property_id')
                    ->groupBy('properties.id')
                    ->orderBy(DB::raw('MAX(tipe_kamars.harga)'), 'desc');
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
        $properties = $query->paginate(12);

        // ✅ PENTING: Pertahankan semua parameter di pagination
        $properties->appends([
            'search' => $searchTerm,
            'cities' => $selectedCities,
            'ratings' => $selectedRatings,
            'facilities' => $selectedFacilities,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'sort' => $sort
        ]);

        // ✅ DEBUG: Log hasil akhir
        Log::info('=== PROPERTY SEARCH RESULTS ===', [
            'total_properties_found' => $properties->total(),
            'current_page_count' => $properties->count(),
            'has_facilities_filter' => !empty($selectedFacilities),
            'selected_facilities' => $selectedFacilities,
            'has_price_filter' => (!empty($minPrice) || !empty($maxPrice)),
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'url' => $request->fullUrl()
        ]);

        // ✅ DATA UNTUK FILTER SIDEBAR - IMPROVED
        // Dapatkan harga minimum dan maximum yang sebenarnya dari database
        $minPriceAvailable = TipeKamar::min('harga') ?? 0;
        $maxPriceAvailable = TipeKamar::max('harga') ?? 2000000;

        $filterData = [
            'cities' => Property::where('is_active', true)
                ->distinct()
                ->pluck('city')
                ->filter()
                ->values(),
            'facilities' => Fasilitas::active()
                ->withCount(['properties' => function($query) {
                    $query->where('is_active', true);
                }])
                ->orderBy('properties_count', 'desc')
                ->orderBy('nama')
                ->get(),
            'min_price_available' => $minPriceAvailable,
            'max_price_available' => $maxPriceAvailable,
        ];

        // Simpan data pencarian ke session jika ada parameter checkin/checkout
        if ($request->hasAny(['checkin', 'checkout', 'total_rooms', 'total_guests'])) {
            session([
                'search_data' => [
                    'checkin' => $request->checkin ?? now()->format('Y-m-d'),
                    'checkout' => $request->checkout ?? now()->addDay()->format('Y-m-d'),
                    'total_rooms' => $request->total_rooms ?? 1,
                    'total_guests' => $request->total_guests ?? 2,
                ]
            ]);
        }

        // ✅ RETURN VIEW LANGSUNG - TANPA REDIRECT
        return view('property.search', compact('properties', 'filterData'));
    }

    /**
     * 🔧 DEBUG METHOD: Cek relasi property-fasilitas untuk troubleshooting
     */
    public function debugFacilities()
    {
        $properties = Property::with('fasilitas')->get();

        $debugInfo = [];
        foreach ($properties as $property) {
            $debugInfo[] = [
                'property_id' => $property->id,
                'property_name' => $property->name,
                'facilities_count' => $property->fasilitas->count(),
                'facilities' => $property->fasilitas->pluck('nama', 'id')->toArray()
            ];
        }

        return response()->json([
            'success' => true,
            'total_properties' => count($debugInfo),
            'properties' => $debugInfo
        ]);
    }

    /**
     * 🔧 DEBUG METHOD: Test filter fasilitas manual
     */
    public function testFacilitiesFilter(Request $request)
    {
        $facilityId = $request->input('facility_id', 2); // Default facility ID 2 (Parkir Gratis)

        $properties = Property::whereHas('fasilitas', function($q) use ($facilityId) {
            $q->where('fasilitas.id', $facilityId);
        })->get();

        $facility = Fasilitas::find($facilityId);

        return response()->json([
            'success' => true,
            'tested_facility' => $facility ? $facility->nama : 'Unknown',
            'facility_id' => $facilityId,
            'matching_properties_count' => $properties->count(),
            'matching_properties' => $properties->map(function($property) {
                return [
                    'id' => $property->id,
                    'name' => $property->name,
                    'facilities' => $property->fasilitas->pluck('nama')
                ];
            })
        ]);
    }

    /**
     * 🔧 DEBUG METHOD: Test filter harga manual
     */
    public function testPriceFilter(Request $request)
    {
        $minPrice = $request->input('min_price', 350000);
        $maxPrice = $request->input('max_price', 17000000);

        $properties = Property::whereHas('tipeKamars', function($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('harga', [$minPrice, $maxPrice]);
        })->get();

        return response()->json([
            'success' => true,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
            'matching_properties_count' => $properties->count(),
            'matching_properties' => $properties->map(function($property) {
                $minPrice = $property->tipeKamars->min('harga');
                $maxPrice = $property->tipeKamars->max('harga');

                return [
                    'id' => $property->id,
                    'name' => $property->name,
                    'price_range' => 'Rp ' . number_format($minPrice, 0, ',', '.') . ' - Rp ' . number_format($maxPrice, 0, ',', '.'),
                    'min_price' => $minPrice,
                    'max_price' => $maxPrice
                ];
            })
        ]);
    }

    /**
     * 🔧 DEBUG METHOD: Perbaiki relasi property tertentu
     */
    public function fixPropertyFacilities($propertyId)
    {
        try {
            $property = Property::with('fasilitas')->find($propertyId);

            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'property' => [
                    'id' => $property->id,
                    'name' => $property->name,
                    'current_facilities' => $property->fasilitas->pluck('nama', 'id')
                ],
                'pivot_data' => DB::table('property_fasilitas')
                    ->where('property_id', $propertyId)
                    ->get()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 🔧 DEBUG METHOD: Cek semua data di tabel pivot
     */
    public function debugPivotTable()
    {
        $pivotData = DB::table('property_fasilitas')
            ->join('properties', 'property_fasilitas.property_id', '=', 'properties.id')
            ->join('fasilitas', 'property_fasilitas.fasilitas_id', '=', 'fasilitas.id')
            ->select(
                'property_fasilitas.id as pivot_id',
                'properties.id as property_id',
                'properties.name as property_name',
                'fasilitas.id as facility_id',
                'fasilitas.nama as facility_name'
            )
            ->get();

        return response()->json([
            'success' => true,
            'total_pivot_records' => $pivotData->count(),
            'pivot_data' => $pivotData
        ]);
    }

    /**
     * 🔧 DEBUG METHOD: Cek harga semua property
     */
    public function debugPropertyPrices()
    {
        $properties = Property::with(['tipeKamars'])->get()->map(function($property) {
            $prices = $property->tipeKamars->pluck('harga');
            return [
                'property_id' => $property->id,
                'property_name' => $property->name,
                'min_price' => $prices->min(),
                'max_price' => $prices->max(),
                'price_range' => $prices->min() . ' - ' . $prices->max(),
                'tipe_kamars_count' => $property->tipeKamars->count(),
                'prices' => $prices->toArray()
            ];
        });

        return response()->json([
            'success' => true,
            'total_properties' => $properties->count(),
            'global_min_price' => TipeKamar::min('harga'),
            'global_max_price' => TipeKamar::max('harga'),
            'properties' => $properties
        ]);
    }
}
