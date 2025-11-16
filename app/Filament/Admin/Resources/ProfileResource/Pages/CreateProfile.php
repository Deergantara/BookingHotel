<?php

namespace App\Filament\Admin\Resources\ProfileResource\Pages;

use App\Filament\Admin\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfile extends CreateRecord
{
    protected static string $resource = ProfileResource::class;
}
