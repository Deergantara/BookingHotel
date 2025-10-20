<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kamar;

class KamarSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel kamars.
     */
    public function run(): void
    {
        // Kamar untuk tipe kamar ID 1 (Deluxe Room)
        for ($i = 1; $i <= 5; $i++) {
            Kamar::create([
                'tipe_kamar_id' => 1,
                'nomor_kamar' => 'D' . str_pad($i, 3, '0', STR_PAD_LEFT), // contoh: D001, D002, ...
                'status' => 'tersedia',
                'lantai' => 'Lantai 2',
                'posisi' => 'Utara',
                'catatan' => 'Dekat dengan kolam renang',
            ]);
        }

        // Kamar untuk tipe kamar ID 2 (Suite Room)
        for ($i = 1; $i <= 3; $i++) {
            Kamar::create([
                'tipe_kamar_id' => 2,
                'nomor_kamar' => 'S' . str_pad($i, 3, '0', STR_PAD_LEFT), // contoh: S001, S002, ...
                'status' => 'ditempati',
                'lantai' => 'Lantai 3',
                'posisi' => 'Selatan',
                'catatan' => 'Menghadap ke taman',
            ]);
        }
    }
}
