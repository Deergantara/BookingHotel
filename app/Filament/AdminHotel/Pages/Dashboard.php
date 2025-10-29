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
        return auth()->user()?->role === 'owner hotel';
    }

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\OwnerHotel\Widgets\AdminHotelStatsWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            \App\Filament\OwnerHotel\Widgets\AdminHotelBookingTrendWidget::class,
            \App\Filament\OwnerHotel\Widgets\AdminHotelBookingStatusWidget::class,
            \App\Filament\OwnerHotel\Widgets\AdminHotelRevenueByMonthWidget::class,
            \App\Filament\OwnerHotel\Widgets\AdminHotelTopPropertiesWidget::class,
            \App\Filament\OwnerHotel\Widgets\AdminHotelYearlySummaryWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 4;
    }
}
