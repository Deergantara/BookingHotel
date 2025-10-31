<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CustomerAccountController extends Controller
{
    /**
     * Tampilkan profil customer
     */
    public function show()
    {
        $user = auth()->user();
        return view('account.show', compact('user'));
    }

    /**
     * Tampilkan form edit profil
     */
    public function edit()
    {
        $user = auth()->user();
        return view('account.edit', compact('user'));
    }

    /**
     * Update profil
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'nomor_identitas' => ['nullable', 'numeric'],
            'tanggal_lahir' => ['nullable', 'date'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Update data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->nomor_identitas = $validated['nomor_identitas'] ?? null;
        $user->tanggal_lahir = $validated['tanggal_lahir'] ?? null;

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('account.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
