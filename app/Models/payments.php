<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'midtrans_order_id',
        'transaction_id',
        'price',
        'payment_type',
        'transaction_time',
        'transaction_status',
        'paid_at',
    ];

    // relasi ke bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'payment_id');
    }
}
