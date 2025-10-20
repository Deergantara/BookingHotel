<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'address',
        'contact',
        'fasilitas',
        'bintang',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // relasi ke Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // relasi ke Bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Property.php
    public function tipe_kamars()
{
    return $this->hasMany(TipeKamar::class, 'property_id');
}



}
