<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Generate dummy payments untuk testing chart
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        
        foreach ($months as $month) {
            for ($i = 0; $i < rand(5, 15); $i++) {
                $price = rand(500000, 5000000);
                $tax = $price * 0.10; // Pajak 10%
                
                Payment::create([
                    'midtrans_order_id' => 'ORDER-' . now()->year . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . rand(1000, 9999),
                    'transaction_id' => 'TRX-' . uniqid(),
                    'price' => $price,
                    'tax' => $tax,
                    'total' => $price + $tax,
                    'payment_type' => 'bank_transfer',
                    'transaction_status' => 'settlement',
                    'transaction_time' => Carbon::create(now()->year, $month, rand(1, 28), rand(0, 23)),
                    'paid_at' => Carbon::create(now()->year, $month, rand(1, 28), rand(0, 23)),
                ]);
            }
        }

        $this->command->info('✅ Payment seeded successfully!');
    }
}