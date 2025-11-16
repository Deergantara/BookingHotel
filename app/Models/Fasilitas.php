<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'icon',
        'deskripsi',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Relasi many-to-many dengan properties
    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_fasilitas');
    }

    // Scope untuk fasilitas aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk kategori tertentu
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
