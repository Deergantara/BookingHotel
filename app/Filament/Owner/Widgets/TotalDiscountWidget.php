<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Coupon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalDiscountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCouponUsed = Coupon::sum('used');

        // Jika ada field discount di payment, gunakan ini:
        // $totalDiscount = Payment::where('transaction_status', 'settlement')
        //     ->sum('discount_amount');

        $totalDiscount = 0; // Sesuaikan dengan struktur data Anda

        return [
            Stat::make('Total Diskon Diberikan', 'Rp ' . number_format($totalDiscount, 0, ',', '.'))
                ->description($totalCouponUsed . ' kupon telah digunakan')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning')
        ];
    }

    protected static ?int $sort = 12;
    protected int | string | array $columnSpan = 1;
}
