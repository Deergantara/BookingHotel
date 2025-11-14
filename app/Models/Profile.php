<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        // kolom lainnya
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}