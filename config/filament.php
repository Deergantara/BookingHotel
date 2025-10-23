<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Panel
    |--------------------------------------------------------------------------
    |
    | Panel yang digunakan Filament saat memuat dashboard default. 
    | Jika kamu memakai multi-panel (admin, owner, resepsionis), 
    | biarkan null agar masing-masing panel pakai providernya sendiri.
    |
    */

    'default_panel' => null,

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | Kamu bisa ubah nama, logo, dan URL dashboard Filament di sini.
    |
    */

    'brand' => [
        'name' => env('APP_NAME', 'BookingHotel'),
        'logo' => null, // bisa isi path ke file logo, misal 'images/logo.png'
        'favicon' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Colors
    |--------------------------------------------------------------------------
    |
    | Warna utama untuk UI Filament.
    |
    */

    'colors' => [
        'primary' => \Filament\Support\Colors\Color::Indigo,
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth Guard
    |--------------------------------------------------------------------------
    |
    | Tentukan guard auth yang digunakan Filament.
    |
    */

    'auth' => [
        'guard' => 'web',
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins
    |--------------------------------------------------------------------------
    |
    | Tempat kamu mendaftarkan plugin tambahan Filament (jika ada).
    |
    */

    'plugins' => [
        // contoh:
        // \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
    ],

];
