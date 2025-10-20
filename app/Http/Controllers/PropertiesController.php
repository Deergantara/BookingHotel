<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\TipeKamar;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Halaman search dengan filter
     */
    public function search(Request $request)
    {
        // Ambil input dari form
        $search = $request->input('search');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $roomTypeId = $request->input('room_type');
        $facilities = $request->input('facilities', []); // array fasilitas

        // Query utama
        $query = Property::query();

        // Pencarian fleksibel
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('area', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter harga berdasarkan tipe kamar
        if ($minPrice || $maxPrice) {
            $query->whereHas('tipe_kamars', function ($q) use ($minPrice, $maxPrice) {
                if ($minPrice)
                    $q->where('harga', '>=', $minPrice);
                if ($maxPrice)
                    $q->where('harga', '<=', $maxPrice);
            });
        }

        // Filter tipe kamar
        if ($roomTypeId) {
            $query->whereHas('tipe_kamars', function ($q) use ($roomTypeId) {
                $q->where('id', $roomTypeId);
            });
        }

        // Filter fasilitas property
        if (!empty($facilities)) {
            $query->where(function ($q) use ($facilities) {
                foreach ($facilities as $f) {
                    $q->orWhere('fasilitas', 'like', "%{$f}%");
                }
            });
        }

        // Ambil hasil akhir
        $properties = $query->get();

        // Data tambahan untuk sidebar filter
        $facilities = ['WiFi', 'AC', 'Kolam Renang', 'Sarapan', 'Parkir']; // contoh daftar fasilitas
        $roomTypes = TipeKamar::all(); // ambil semua tipe kamar

        return view('property.search', compact('properties', 'search', 'roomTypes', 'facilities'));
    }

    /**
     * Halaman detail property
     */
    public function show($id)
    {
        $property = Property::with('tipe_kamars.kamars')->findOrFail($id); 
        // include relasi kamar agar bisa menampilkan status masing-masing kamar
        $tipeKamars = $property->tipe_kamars;

        return view('property.show', compact('property', 'tipeKamars'));
    }

}
