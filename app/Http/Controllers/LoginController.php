<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    /**
     * Proses login user.
     */
    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Coba login dulu
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirect berdasarkan role
        if (Auth::user()->role === 'user') {
            return redirect('/')->with('success', 'Login berhasil sebagai user!');
        } elseif (Auth::user()->role === 'admin') {
            return redirect('/dashboard')->with('success', 'Login berhasil sebagai admin!');
        }

        // Default redirect kalau role tidak diketahui
        return redirect('/')->with('success', 'Login berhasil!');
    }

    // Kalau gagal login
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}


    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda sudah logout.');
    }
}
