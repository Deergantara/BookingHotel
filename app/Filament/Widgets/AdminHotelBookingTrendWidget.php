<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Property;
use Filament\Widgets\ChartWidget;

class AdminHotelBookingTrendWidget extends ChartWidget
{
    protected static ?string $heading = 'Booking Trend (Last 30 Days)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');

        $data = [];
        $labels = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = Booking::whereIn('property_id', $propertyIds)
                ->whereDate('created_at', $date)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Booking',
                    'data' => $data,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => true,
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
