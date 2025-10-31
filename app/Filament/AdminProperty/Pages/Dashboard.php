<?php

namespace App\Filament\AdminProperty\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';

    protected static ?string $title = 'Dashboard Admin Property';


    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin property';
    }

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\AdminProperty\Widgets\PropertyInfoWidget::class,
            \App\Filament\AdminProperty\Widgets\PropertyStatsWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            \App\Filament\AdminProperty\Widgets\BookingTrendWidget::class,
            \App\Filament\AdminProperty\Widgets\BookingStatusWidget::class,
            \App\Filament\AdminProperty\Widgets\RevenueByMonthWidget::class,
            \App\Filament\AdminProperty\Widgets\RoomStatusWidget::class,
            \App\Filament\AdminProperty\Widgets\TopRoomsWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return 2;
    }
}
