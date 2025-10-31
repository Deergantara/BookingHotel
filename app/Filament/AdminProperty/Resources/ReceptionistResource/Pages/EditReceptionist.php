<?php

namespace App\Filament\AdminProperty\Resources\ReceptionistResource\Pages;

use App\Filament\AdminProperty\Resources\ReceptionistResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReceptionist extends EditRecord
{
    protected static string $resource = ReceptionistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
