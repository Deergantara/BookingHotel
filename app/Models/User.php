<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'hotel_id',
        'property_id',
        'nomor_identitas',
        'tanggal_lahir',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // relasi ke hotel
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    // relasi ke property
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // relasi ke Bookings
    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

        // Helper method untuk cek role
        public function isResepsionis(): bool
        {
            return $this->role === 'resepsionis';
        }
    
        public function isAdminSystem(): bool
        {
            return $this->role === 'admin system';
        }
    
        public function isOwnerHotel(): bool
        {
            return $this->role === 'owner hotel';
        }

        public function isAdminProperty(): bool
        {
            return $this->role === 'admin property';
        }

        public function isAdminHotel(): bool
        {
            return $this->role === 'admin hotel';
        }
        public function isOwnerSystem(): bool
        {
            return $this->role === 'owner system';
        }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
