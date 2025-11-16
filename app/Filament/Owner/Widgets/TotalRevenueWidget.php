<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalRevenueWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Payment::where('transaction_status', 'settlement')
            ->sum('tax');

        return [
            Stat::make('Total Revenue (Tax 10%)', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Pendapatan dari pajak booking')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
        ];
    }

    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 1;
}
