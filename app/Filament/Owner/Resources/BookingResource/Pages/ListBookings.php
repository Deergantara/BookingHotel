<?php

namespace App\Filament\Owner\Resources\BookingResource\Pages;

use App\Filament\Owner\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // No create action for read-only
        ];
    }
}
