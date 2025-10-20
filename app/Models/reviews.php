<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'star',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'review_id');
    }
}
