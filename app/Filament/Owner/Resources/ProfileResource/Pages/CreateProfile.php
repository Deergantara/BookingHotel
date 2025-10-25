<?php

namespace App\Filament\Owner\Resources\ProfileResource\Pages;

use App\Filament\Owner\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
