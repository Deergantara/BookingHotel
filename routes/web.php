<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KamarController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [PropertiesController::class, 'search'])->name('property.search');
Route::get('/property/{id}', [PropertiesController::class, 'show'])->name('property.show');

Route::get('/pilih-kamar/{id}', [KamarController::class, 'pilihKamar'])->name('pilih.kamar');
Route::get('/pesan-sekarang', [KamarController::class, 'pesanSekarang'])->name('pesan.sekarang');

// ✅ TAMBAHKAN ROUTE BOOKING INI
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
