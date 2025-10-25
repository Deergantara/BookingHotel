<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class AdminHotelDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static string $view = 'filament.pages.admin-hotel-dashboard';

    protected static ?string $navigationLabel = 'Hotel Dashboard';

    protected static ?string $title = 'Hotel Management Dashboard';

    protected static ?int $navigationSort = 1;

    // Hanya admin hotel & owner hotel yang bisa akses
    public static function canAccess(): bool
    {
        return in_array(auth()->user()?->role, ['admin hotel', 'owner hotel']);
    }

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\AdminHotelStatsWidget::class,
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\AdminHotelBookingTrendWidget::class,
            \App\Filament\Widgets\AdminHotelBookingStatusWidget::class,
            \App\Filament\Widgets\AdminHotelRevenueByMonthWidget::class,
            \App\Filament\Widgets\AdminHotelTopPropertiesWidget::class,
            \App\Filament\Widgets\AdminHotelYearlySummaryWidget::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int | array
    {
        return 4;
    }
}
