<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            // Fasilitas Umum
            ['nama' => 'WiFi', 'kategori' => 'umum', 'icon' => 'wifi'],
            ['nama' => 'Parkir Gratis', 'kategori' => 'umum', 'icon' => 'parking'],
            ['nama' => 'Resepsionis 24 Jam', 'kategori' => 'umum', 'icon' => 'clock'],
            ['nama' => 'AC', 'kategori' => 'umum', 'icon' => 'snowflake'],
            ['nama' => 'Elevator', 'kategori' => 'umum', 'icon' => 'arrow-up'],

            // Fasilitas Hotel
            ['nama' => 'Kolam Renang', 'kategori' => 'hotel', 'icon' => 'swimming-pool'],
            ['nama' => 'Spa', 'kategori' => 'hotel', 'icon' => 'spa'],
            ['nama' => 'Fitness Center', 'kategori' => 'hotel', 'icon' => 'dumbbell'],
            ['nama' => 'Restoran', 'kategori' => 'hotel', 'icon' => 'utensils'],
            ['nama' => 'Bar', 'kategori' => 'hotel', 'icon' => 'cocktail'],

            // Fasilitas Kamar
            ['nama' => 'TV LED', 'kategori' => 'kamar', 'icon' => 'tv'],
            ['nama' => 'Mini Bar', 'kategori' => 'kamar', 'icon' => 'wine-bottle'],
            ['nama' => 'Kamar Mandi Dalam', 'kategori' => 'kamar', 'icon' => 'bath'],
            ['nama' => 'Bathtub', 'kategori' => 'kamar', 'icon' => 'bath'],
            ['nama' => 'Shower', 'kategori' => 'kamar', 'icon' => 'shower'],

            // Fasilitas Restoran
            ['nama' => 'Breakfast Included', 'kategori' => 'restoran', 'icon' => 'coffee'],
            ['nama' => 'Room Service', 'kategori' => 'restoran', 'icon' => 'concierge-bell'],
            ['nama' => 'Buffet', 'kategori' => 'restoran', 'icon' => 'utensils'],

            // Fasilitas Rekreasi
            ['nama' => 'Kids Club', 'kategori' => 'rekreasi', 'icon' => 'child'],
            ['nama' => 'Tennis Court', 'kategori' => 'rekreasi', 'icon' => 'table-tennis'],
            ['nama' => 'Golf Course', 'kategori' => 'rekreasi', 'icon' => 'golf-ball'],
        ];

        foreach ($fasilitas as $fasilitasData) {
            Fasilitas::create($fasilitasData);
        }

        $this->command->info('Berhasil menambahkan ' . count($fasilitas) . ' fasilitas dasar.');
    }
}
