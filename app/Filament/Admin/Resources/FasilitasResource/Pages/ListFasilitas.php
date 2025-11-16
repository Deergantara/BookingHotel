<?php

namespace App\Filament\Admin\Resources\FasilitasResource\Pages;

use App\Filament\Admin\Resources\FasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFasilitas extends ListRecords
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
