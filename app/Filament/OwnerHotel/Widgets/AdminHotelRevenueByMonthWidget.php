<?php

namespace App\Filament\OwnerHotel\Widgets;

use App\Models\Payment;
use App\Models\Property;
use Filament\Widgets\ChartWidget;

class AdminHotelRevenueByMonthWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue by Month (2025)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');

        $year = 2025;
        $data = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 1));

            $revenue = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                    $q->whereIn('property_id', $propertyIds);
                })
                ->where('transaction_status', 'settlement')
                ->whereYear('paid_at', $year)
                ->whereMonth('paid_at', $month)
                ->sum('price');

            $data[] = $revenue;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (Rp)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
