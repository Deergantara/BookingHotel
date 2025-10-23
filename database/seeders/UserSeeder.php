<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Property;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Admin System (Super Admin)
        User::create([
            'name' => 'Admin System',
            'email' => 'admin@system.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role' => 'admin system',
            'nomor_identitas' => 3174012345678901,
            'tanggal_lahir' => '1990-01-15',
        ]);

        // 2. Owner System
        User::create([
            'name' => 'Owner System',
            'email' => 'owner@system.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'role' => 'owner system',
            'nomor_identitas' => 3174012345678902,
            'tanggal_lahir' => '1985-05-20',
        ]);

        // 3. Customer/User Biasa
        User::create([
            'name' => 'John Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'role' => 'user',
            'nomor_identitas' => 3174012345678903,
            'tanggal_lahir' => '1995-08-10',
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@test.com',
            'password' => Hash::make('password'),
            'phone' => '081234567893',
            'role' => 'user',
            'nomor_identitas' => 3174012345678904,
            'tanggal_lahir' => '1998-12-25',
        ]);

        // === USERS YANG TERKAIT HOTEL/PROPERTY ===
        // Hanya dibuat jika sudah ada Hotel & Property
        
        // Cek apakah ada Hotel
        $hotel = Hotel::first();
        
        if ($hotel) {
            // 4. Owner Hotel
            User::create([
                'name' => 'Owner Hotel Mewah',
                'email' => 'owner@hotel.com',
                'password' => Hash::make('password'),
                'phone' => '081234567894',
                'role' => 'owner hotel',
                'hotel_id' => $hotel->id,
                'nomor_identitas' => 3174012345678905,
                'tanggal_lahir' => '1980-03-15',
            ]);

            // 5. Admin Hotel
            User::create([
                'name' => 'Admin Hotel Mewah',
                'email' => 'admin@hotel.com',
                'password' => Hash::make('password'),
                'phone' => '081234567895',
                'role' => 'admin hotel',
                'hotel_id' => $hotel->id,
                'nomor_identitas' => 3174012345678906,
                'tanggal_lahir' => '1992-07-22',
            ]);
        }

        // Cek apakah ada Property
        $property = Property::first();
        
        if ($property) {
            // 6. Admin Property
            User::create([
                'name' => 'Admin Property Jakarta',
                'email' => 'admin@property.com',
                'password' => Hash::make('password'),
                'phone' => '081234567896',
                'role' => 'admin property',
                'property_id' => $property->id,
                'nomor_identitas' => 3174012345678907,
                'tanggal_lahir' => '1993-09-18',
            ]);

            // 7. Resepsionis
            User::create([
                'name' => 'Resepsionis Shift 1',
                'email' => 'resepsionis1@property.com',
                'password' => Hash::make('123123'),
                'phone' => '081234567897',
                'role' => 'resepsionis',
                'property_id' => $property->id,
                'nomor_identitas' => 3174012345678908,
                'tanggal_lahir' => '1997-11-05',
            ]);

            User::create([
                'name' => 'Resepsionis Shift 2',
                'email' => 'resepsionis2@property.com',
                'password' => Hash::make('password'),
                'phone' => '081234567898',
                'role' => 'resepsionis',
                'property_id' => $property->id,
                'nomor_identitas' => 3174012345678909,
                'tanggal_lahir' => '1996-04-30',
            ]);
        }

        $this->command->info('✅ Users seeded successfully!');
    }
}