<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'user_id',
        'property_id',
        'kamar_id',
        'payment_id',
        'review_id',
        'checkin_date',
        'checkout_date',
        'status',
        'created_by',
        'is_offline',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
