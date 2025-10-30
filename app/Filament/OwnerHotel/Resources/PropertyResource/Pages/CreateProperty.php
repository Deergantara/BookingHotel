<?php

namespace App\Filament\OwnerHotel\Resources\PropertyResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\OwnerHotel\Resources\PropertyResource;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Property berhasil ditambahkan!';
    }
}
