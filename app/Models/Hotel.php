<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <- ini penting
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tdup',
        'npwp',
        'status',   
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    // relasi ke users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // relasi ke bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
