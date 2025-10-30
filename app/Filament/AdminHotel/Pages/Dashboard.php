<?php

namespace App\Filament\AdminHotel\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static string $view = 'filament.pages.admin-hotel-dashboard';

    protected static ?string $navigationLabel = 'Hotel Dashboard';

    protected static ?string $title = 'Hotel Management Dashboard';

    protected static ?int $navigationSort = 1;

    // Hanya admin hotel & owner hotel yang bisa akses
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin hotel';
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            AccountWidget::class,
            FilamentInfoWidget::class,
        ];
    }
}
