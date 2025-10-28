<?php

namespace App\Filament\Resources\PropertyStaffResource\Pages;

use App\Filament\Resources\PropertyStaffResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreatePropertyStaff extends CreateRecord
{
    protected static string $resource = PropertyStaffResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Staff berhasil ditambahkan!';
    }

    // ✅ Auto hash password
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['password']) && filled($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
