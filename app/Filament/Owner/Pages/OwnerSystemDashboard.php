<?php

namespace App\Filament\Owner\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class OwnerSystemDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static string $view = 'filament.owner.pages.owner-system-dashboard';
    
    protected static ?string $navigationLabel = 'Owner Dashboard';
    
    protected static ?string $title = 'Owner System Dashboard';
    
    protected static ?int $navigationSort = 1;

    // Hanya owner system yang bisa akses
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'owner system';
    }

    // ✅ UBAH JADI PUBLIC
    public function getHeaderWidgets(): array
    {
        return [
            
        ];
    }

    // ✅ UBAH JADI PUBLIC
    public function getFooterWidgets(): array
    {
        return [
            \App\Filament\Owner\Widgets\BookingPerDayChartWidget::class,      // ✅ UPDATE
            \App\Filament\Owner\Widgets\TaxPerMonthChartWidget::class, 
            \App\Filament\Owner\Widgets\OwnerStatsWidget::class,       // ✅ UPDATE
        ];
    }

    // ✅ UBAH JADI PUBLIC (Ini yang error)
    public function getHeaderWidgetsColumns(): int | array
    {
        return 4;
    }
}