<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\BookingController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [PropertiesController::class, 'search'])->name('property.search');
Route::get('/property/{id}', [PropertiesController::class, 'show'])->name('property.show');

Route::post('/booking/create', [BookingController::class, 'store'])->name('booking.create');

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