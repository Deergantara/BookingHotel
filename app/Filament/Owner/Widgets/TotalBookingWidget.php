<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class TotalBookingWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $yearlyBookings = Booking::whereYear('created_at', Carbon::now()->year)
            ->whereIn('status', ['confirmed', 'checked_in', 'completed'])
            ->count();

        return [
            Stat::make('Total Booking Tahun Ini', $yearlyBookings)
                ->description('Booking yang berhasil')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success')
                ->chart([10, 15, 12, 18, 20, 22, 25, 23])
        ];
    }

    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 1;
}
