<?php

namespace App\Filament\Admin\Resources\FasilitasResource\Pages;

use App\Filament\Admin\Resources\FasilitasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFasilitas extends EditRecord
{
    protected static string $resource = FasilitasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
