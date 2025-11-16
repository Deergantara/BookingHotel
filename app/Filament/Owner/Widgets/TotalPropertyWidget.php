<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Property;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalPropertyWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProperties = Property::where('is_active', true)->count();

        return [
            Stat::make('Total Property Aktif', $totalProperties)
                ->description('Dari semua hotel')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('warning')
                ->chart([4, 5, 3, 6, 7, 5, 8, 7])
        ];
    }

    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;
}
