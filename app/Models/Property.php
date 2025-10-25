<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'foto',
        'name',
        'address',
        'city',
        'area',
        'contact',
        'jumlah_kamar',
        'kapasitas_tamu',
        'available_from',
        'available_to',
        'fasilitas',
        'bintang',
        'is_active',
    ];

    protected $casts = [
        'foto' => 'array',
        'is_active' => 'boolean',
        'bintang' => 'decimal:1',
        'available_from' => 'date',
        'available_to' => 'date',
    ];

    /**
     * Relasi ke Hotel
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    /**
     * Relasi ke Tipe Kamar (camelCase untuk Laravel convention)
     */
    public function tipeKamars()
    {
        return $this->hasMany(TipeKamar::class);
    }

    /**
     * Alias untuk relasi tipe_kamars (snake_case)
     * Gunakan ini jika di controller pakai 'tipe_kamars'
     */
    public function tipe_kamars()
    {
        return $this->tipeKamars();
    }

    /**
     * Relasi ke Reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke Bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Relasi ke Users (staff property)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Accessor untuk mendapatkan foto pertama
     */
    public function getFirstPhotoAttribute()
    {
        $fotos = $this->foto;
        return is_array($fotos) && count($fotos) > 0 ? $fotos[0] : null;
    }

    /**
     * Accessor untuk harga terendah
     */
    public function getMinPriceAttribute()
    {
        return $this->tipeKamars()->min('harga') ?? 0;
    }

    /**
     * Accessor untuk rata-rata rating
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('star') ?? 0;
    }

    /**
     * Scope untuk property yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter berdasarkan kota
     */
    public function scopeByCity($query, $city)
    {
        return $query->where('city', 'LIKE', "%{$city}%");
    }
}