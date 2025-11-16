<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopHotelsChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Hotel dengan Booking Terbanyak';

    protected static ?int $sort = 8;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $topHotels = Booking::join('properties', 'bookings.property_id', '=', 'properties.id')
            ->join('hotels', 'properties.hotel_id', '=', 'hotels.id')
            ->select('hotels.nama', DB::raw('COUNT(bookings.id) as total_bookings'))
            ->whereIn('bookings.status', ['confirmed', 'checked_in', 'completed'])
            ->groupBy('hotels.id', 'hotels.nama')
            ->orderByDesc('total_bookings')
            ->limit(5)
            ->get();

        $labels = $topHotels->pluck('nama')->toArray();
        $data = $topHotels->pluck('total_bookings')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Booking',
                    'data' => $data,
                    'backgroundColor' => [
                        '#3b82f6',
                        '#8b5cf6',
                        '#ec4899',
                        '#f59e0b',
                        '#10b981',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

protected function getOptions(): array
{
    return [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
        'scales' => [
            'y' => [
                'beginAtZero' => true,
            ],
        ],
    ];
}

    protected function getType(): string
    {
        return 'bar';
    }
}
