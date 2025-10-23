<?php

namespace App\Filament\Resepsionis\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Resepsionis\Widgets\TodayCheckInsWidget;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    // Di sini kamu bisa atur widget yang muncul di dashboard
    protected function getHeaderWidgets(): array
    {
        return [
            TodayCheckInsWidget::class, // ✅ Tambahkan widget kamu di sini
            AccountWidget::class,
            FilamentInfoWidget::class,
        ];
    }
}
