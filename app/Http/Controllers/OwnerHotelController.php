<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use Illuminate\Support\Facades\Hash;

class OwnerHotelController extends Controller
{
    // Tampilkan form
    public function showForm()
    {
        return view('work-with-us');
    }

    // Simpan data owner hotel & hotel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',

            'hotel_nama' => 'required|string|max:255',
            'hotel_tdup' => 'nullable|string|max:255',
            'hotel_npwp' => 'required|string|max:100',
        ]);

        // Simpan hotel dulu
        $hotel = Hotel::create([
            'nama' => $validated['hotel_nama'],
            'tdup' => $validated['hotel_tdup'],
            'npwp' => $validated['hotel_npwp'],
            'status' => 'pending', // default
        ]);

        // Simpan user owner hotel
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'owner hotel',
            'hotel_id' => $hotel->id,
        ]);

        return redirect()->route('work.with.us')
            ->with('success', 'Pendaftaran berhasil! Admin akan memverifikasi data Anda.');
    }
}
