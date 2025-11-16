<?php

namespace App\Filament\Owner\Resources\PropertyResource\Pages;

use App\Filament\Owner\Resources\PropertyResource;
use Filament\Resources\Pages\ListRecords;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action for owner
        ];
    }
}
