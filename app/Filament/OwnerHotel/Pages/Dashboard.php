<?php

namespace App\Filament\OwnerHotel\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';
    
    protected static ?string $title = 'Dashboard Owner Hotel';

    // Hanya owner hotel yang bisa akses
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'owner hotel';
    }

    public function getHeaderWidgets(): array
    {
        return [
            // Widget akan ditambahkan nanti
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            // Widget akan ditambahkan nanti
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 4;
    }
}