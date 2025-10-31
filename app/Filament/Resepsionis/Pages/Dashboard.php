<?php

namespace App\Filament\Resepsionis\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';

    protected static ?string $title = 'Dashboard Resepsionis';

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'resepsionis';
    }

    public function getHeaderWidgets(): array
    {
        return [

        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            \App\Filament\Resepsionis\Widgets\TodayCheckInsWidget::class,
            \App\Filament\Resepsionis\Widgets\TodayCheckOutsWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 2;
    }
}
