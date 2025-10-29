<?php

namespace App\Filament\Resources\PropertyStaffResource\Pages;

use App\Filament\Resources\PropertyStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditPropertyStaff extends EditRecord
{
    protected static string $resource = PropertyStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Staff berhasil diupdate!';
    }

    // ✅ Auto hash password jika diisi
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['password']) && filled($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }
}
