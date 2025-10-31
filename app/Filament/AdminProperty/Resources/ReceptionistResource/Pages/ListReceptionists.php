<?php

namespace App\Filament\AdminProperty\Resources\ReceptionistResource\Pages;

use App\Filament\AdminProperty\Resources\ReceptionistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReceptionists extends ListRecords
{
    protected static string $resource = ReceptionistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
