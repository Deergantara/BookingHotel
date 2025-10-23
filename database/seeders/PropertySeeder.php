<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Cabang pertama
        Property::create([
            'hotel_id' => 1,
            'name' => 'Hotel Citamiang Indah',
            'address' => 'Jl. Pelabuhan II No.123, Citamiang, Sukabumi',
            'city' => 'Sukabumi',
            'area' => 'Citamiang',
            'contact' => '0852-1234-5678',
            'fasilitas' => 'WiFi, AC, Parkir, Sarapan, Kolam Renang',
            'bintang' => 4,
            'jumlah_kamar' => 20,
            'kapasitas_tamu' => 40,
            'foto' => ['hotel.jpg', 'hotel2.jpg'], // ✅ Laravel auto-encode
        ]);

        // Cabang kedua
        Property::create([
            'hotel_id' => 1,
            'name' => 'Pulau Resort Sukabumi',
            'address' => 'Jl. Pantai Selatan No.45, Cisolok, Sukabumi',
            'city' => 'Sukabumi',
            'area' => 'citamiang',
            'contact' => '0857-9876-5432',
            'fasilitas' => 'WiFi, Restoran, Pantai Pribadi, Spa',
            'bintang' => 5,
            'jumlah_kamar' => 30,
            'kapasitas_tamu' => 60,
            'foto' => ['hotel.jpg', 'hotel2.jpg'], // ✅ Laravel auto-encode
        ]);
    }
}
