<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            HotelSeeder::class,
            PropertySeeder::class,
            TipeKamarSeeder::class,
            KamarSeeder::class,
            UserSeeder::class,
        ]);
    }
}
