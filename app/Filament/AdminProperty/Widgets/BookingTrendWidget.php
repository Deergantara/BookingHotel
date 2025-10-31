<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingTrendWidget extends ChartWidget
{
    protected static ?string $heading = 'Booking Trend (30 Days)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $propertyId = auth()->user()->property_id;

        if (!$propertyId) {
            return ['datasets' => [], 'labels' => []];
        }

        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $labels[] = $date->format('d M');

            $count = Booking::where('property_id', $propertyId)
                ->whereDate('created_at', $date)
                ->count();

            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
