<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars';

    protected $fillable = [
        'tipe_kamar_id',
        'nomor_kamar',
        'status',
        'lantai',
        'posisi',
        'catatan',
    ];

    // relasi ke tipe_kamar
    public function tipeKamar()
{
    return $this->belongsTo(TipeKamar::class, 'tipe_kamar_id');
}

    // label status
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }

    // scope untuk filter kamar tersedia
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    // relasi ke Bookings
    public function Bookings()
    {
        return $this->hasMany(Booking::class, 'kamar_id');
    }
}
