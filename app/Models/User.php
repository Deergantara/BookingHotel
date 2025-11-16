<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

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

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'owner') {
            return $this->isOwnerSystem();
        }

        if ($panel->getId() === 'admin') {
            return $this->isAdminSystem() || $this->isAdminHotel() || $this->isAdminProperty();
        }

        return false;
    }

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
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isCustomer(): bool
    {
        return $this->role === 'user';
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

    public function getFormattedRoleAttribute(): string
    {
        return match($this->role) {
            'admin system' => 'Admin System',
            'owner system' => 'Owner System',
            'admin hotel' => 'Admin Hotel',
            'owner hotel' => 'Owner Hotel',
            'admin property' => 'Admin Property',
            'resepsionis' => 'Resepsionis',
            'user' => 'Customer',
            default => ucfirst($this->role)
        };
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
        ];
    }
}
