<?php

namespace App\Filament\Resepsionis\Resources\KamarResource\Pages;

use App\Filament\Resepsionis\Resources\KamarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKamars extends ListRecords
{
    protected static string $resource = KamarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
