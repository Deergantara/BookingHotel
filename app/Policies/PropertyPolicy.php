<?php

namespace App\Policies;

use App\Models\Property;
use App\Models\User;

class PropertyPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin hotel';
    }

    public function view(User $user, Property $property): bool
    {
        return $user->role === 'admin hotel' && $property->hotel_id === $user->hotel_id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin hotel' && !is_null($user->hotel_id);
    }

    public function update(User $user, Property $property): bool
    {
        return $user->role === 'admin hotel' && $property->hotel_id === $user->hotel_id;
    }

    public function delete(User $user, Property $property): bool
    {
        return $user->role === 'admin hotel' && $property->hotel_id === $user->hotel_id;
    }

    public function restore(User $user, Property $property): bool
    {
        return $user->role === 'admin hotel' && $property->hotel_id === $user->hotel_id;
    }

    public function forceDelete(User $user, Property $property): bool
    {
        return $user->role === 'admin hotel' && $property->hotel_id === $user->hotel_id;
    }
}
