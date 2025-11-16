<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Hotel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalHotelWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalHotels = Hotel::whereIn('status', ['verified', 'active'])->count();

        return [
            Stat::make('Total Hotel Kerjasama', $totalHotels)
                ->description('Hotel yang aktif bekerja sama')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info')
                ->chart([3, 2, 5, 4, 6, 7, 8, 6])
        ];
    }

    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;
}
