<?php

namespace App\Filament\AdminHotel\Resources\PropertyResource\Pages;

use App\Filament\OwnerHotel\Resources\PropertyResource;
use Filament\Resources\Pages\CreateRecord;

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
