<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NetAmountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $netAmount = Payment::where('transaction_status', 'settlement')
            ->sum('price');

        return [
            Stat::make('Total Net Amount', 'Rp ' . number_format($netAmount, 0, ',', '.'))
                ->description('Total setelah diskon')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('success')
        ];
    }

    protected static ?int $sort = 13;
    protected int | string | array $columnSpan = 1;
}
