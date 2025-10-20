<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        Hotel::create([
            'nama' => 'Hotel Citamiang Group',
            'tdup' => null,
            'npwp' => 9876543210,
            'status' => 'verified',
        ]);
    }
}
