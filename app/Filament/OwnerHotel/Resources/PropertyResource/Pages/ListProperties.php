<?php

namespace App\Filament\OwnerHotel\Resources\PropertyResource\Pages;

use App\OwnerHotel\Filament\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProperties extends ListRecords
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Property')
                ->icon('heroicon-o-plus'),
        ];
    }
}