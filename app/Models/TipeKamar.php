<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    use HasFactory;

    // Tambahkan ini karena tabel kamu bernama 'tipe_kamar' (singular)

    protected $fillable = [
        'property_id',
        'nama_tipe',
        'deskripsi',
        'kapasitas',
        'harga',
        'fasilitas_kamar',
        'stok_kamar',
        'foto',
    ];

    protected $casts = [
        'fasilitas_kamar' => 'array',
    ];

    // relasi ke property
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        return asset('storage/tipe_kamar/' . $this->foto);
    }

    // relasi ke kamar
    public function kamars()
    {
        return $this->hasMany(Kamar::class, 'tipe_kamar_id');
    }
}
