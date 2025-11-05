<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerAccountController;
use App\Http\Controllers\OwnerHotelController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tidak perlu login)
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('homepage');

// Property & Search Routes
Route::get('/search', [PropertiesController::class, 'search'])->name('property.search');
Route::get('/property/{property}', [PropertiesController::class, 'show'])->name('property.show');

/*
|--------------------------------------------------------------------------
| BOOKING ROUTES - BISA TANPA LOGIN!
|--------------------------------------------------------------------------
*/

// Halaman form booking (TIDAK perlu login)
// URL: /booking/{property}?checkin=...&checkout=...&total_guests=...&total_rooms=...
Route::get('/booking/{property}', [BookingController::class, 'create'])->name('booking.create');

// Proses simpan booking (TIDAK perlu login)
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Halaman konfirmasi booking setelah berhasil (TIDAK perlu login)
Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');

// Auth Routes (Login & Register)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Work with us (Owner Hotel Registration)
Route::get('/work-with-us', [OwnerHotelController::class, 'showForm'])->name('work.with.us');
Route::post('/work-with-us', [OwnerHotelController::class, 'store'])->name('work.with.us.store');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Harus login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Detail booking (untuk user yang login)
    Route::get('/booking/{booking}/detail', [BookingController::class, 'show'])->name('booking.show');

    // Daftar semua booking user
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');

    // Cancel booking
    Route::post('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER ROUTES
    |--------------------------------------------------------------------------
    */

    // Customer Dashboard
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    // Customer Bookings
    Route::get('/customer/bookings', [BookingController::class, 'index'])->name('customer.bookings');

    // Customer Profile
    Route::get('/profile', function () {
        return view('customer.profile');
    })->name('customer.profile');

    /*
    |--------------------------------------------------------------------------
    | KAMAR ROUTES (Jika masih digunakan)
    |--------------------------------------------------------------------------
    */

    Route::get('/pilih-kamar/{id}', [KamarController::class, 'pilihKamar'])->name('pilih.kamar');
    Route::get('/pesan-sekarang', [KamarController::class, 'pesanSekarang'])->name('pesan.sekarang');
});

/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE (404 Custom)
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
