<?php

namespace Database\Seeders;

use App\Models\TipeKamar;
use Illuminate\Database\Seeder;

class TipeKamarSeeder extends Seeder
{
    public function run()
    {
        TipeKamar::create([
            'property_id' => 1,
            'nama_tipe' => 'Deluxe Room',
            'deskripsi' => 'Kamar luas dengan balkon dan TV layar datar.',
            'kapasitas' => 2,
            'harga' => 350000,
            'fasilitas_kamar' => json_encode(["WiFi", "AC", "TV", "Air Panas", "Sarapan"]),
            'stok_kamar' => 8,
            'foto' => 'pulau.jpg',
        ]);

        TipeKamar::create([
            'property_id' => 1,
            'nama_tipe' => 'Suite Room',
            'deskripsi' => 'Kamar besar dengan ruang tamu dan view kota.',
            'kapasitas' => 4,
            'harga' => 750000,
            'fasilitas_kamar' => json_encode(["WiFi", "AC", "Bathtub", "Mini Bar", "View Kota"]),
            'stok_kamar' => 4,
            'foto' => 'suite.jpg',
        ]);

        TipeKamar::create([
            'property_id' => 2,
            'nama_tipe' => 'Deluxe Room',
            'deskripsi' => 'Kamar luas dengan balkon dan TV layar datar.',
            'kapasitas' => 4,
            'harga' => 750000,
            'fasilitas_kamar' => json_encode(["WiFi", "AC", "Bathtub", "Mini Bar", "View Kota"]),
            'stok_kamar' => 4,
            'foto' => 'suite.jpg',
        ]);
    }
}

