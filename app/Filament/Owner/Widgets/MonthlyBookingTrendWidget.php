<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyBookingTrendWidget extends ChartWidget
{
    protected static ?string $heading = 'Trend Booking Bulanan';

    protected static ?int $sort = 9;

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $bookings = Booking::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->whereIn('status', ['confirmed', 'checked_in', 'completed'])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $data = array_fill(0, 12, 0);

        foreach ($bookings as $booking) {
            $data[$booking->month - 1] = $booking->total;
        }

       return [
    'datasets' => [
        [
            'label' => 'Total Booking',
            'data' => $data,
            'borderColor' => '#f59e0b',
            'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
            'fill' => true,
            'tension' => 0.3, // 👈 Smooth line
        ],
    ],
    'labels' => $months,
];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
