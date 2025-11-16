<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GrossAmountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $grossAmount = Payment::where('transaction_status', 'settlement')
            ->sum('total');

        return [
            Stat::make('Total Gross Amount', 'Rp ' . number_format($grossAmount, 0, ',', '.'))
                ->description('Total sebelum diskon')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info')
        ];
    }

    protected static ?int $sort = 11;
    protected int | string | array $columnSpan = 1;
}
