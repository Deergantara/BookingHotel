<?php

namespace App\Filament\Admin\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak perlu actions untuk profile
        ];
    }

    public function mount(int | string $record): void
    {
        $user = Auth::user();

        // Pastikan user hanya bisa akses profil sendiri
        if ($user->id != $record) {
            abort(403, 'You can only edit your own profile.');
        }

        // Load record
        $this->record = User::findOrFail($record);

        // Isi form dengan data
        $this->fillForm();
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }

    public function getTitle(): string
    {
        return 'Edit Profile - ' . Auth::user()->name;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => Auth::id()]);
    }
}
