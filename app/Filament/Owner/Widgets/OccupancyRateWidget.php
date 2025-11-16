<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Kamar;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OccupancyRateWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::whereIn('status', ['dipesan', 'ditempati'])->count();

        $occupancyRate = $totalKamar > 0
            ? round(($kamarTerisi / $totalKamar) * 100, 1)
            : 0;

        return [
            Stat::make('Tingkat Hunian', $occupancyRate . '%')
                ->description($kamarTerisi . ' dari ' . $totalKamar . ' kamar terisi')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($occupancyRate > 70 ? 'success' : 'warning')
                ->chart([60, 65, 70, 68, 72, 75, 73, 70])
        ];
    }

    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 1;
}
