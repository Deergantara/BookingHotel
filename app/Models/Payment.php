<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // app/Models/Payment.php
    protected $fillable = [
        'midtrans_order_id',
        'transaction_id',
        'price',
        'tax',           // ← Tambahkan
        'total',         // ← Tambahkan
        'payment_type',
        'transaction_time',
        'transaction_status',
        'paid_at',
    ];

    // relasi ke Bookings
    public function Bookings()
    {
        return $this->hasMany(Booking::class, 'payment_id');
    }
}
