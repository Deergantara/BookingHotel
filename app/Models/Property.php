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

    protected $casts = [
        'foto' => 'array', // Cast foto jadi array
        'is_active' => 'boolean',
        'bintang' => 'decimal:1',
        'available_from' => 'date',
        'available_to' => 'date',
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
    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Property.php
    public function tipe_kamars()
{
    return $this->hasMany(TipeKamar::class, 'property_id');
}



}
