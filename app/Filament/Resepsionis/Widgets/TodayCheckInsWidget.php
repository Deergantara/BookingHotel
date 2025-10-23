<?php

namespace App\Filament\Resepsionis\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayCheckInsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Welcome', 'Selamat Datang Resepsionis')
                ->description('Dashboard sedang dikembangkan')
                ->descriptionIcon('heroicon-m-check')
                ->color('success'),
        ];
    }
}