<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;

class RevenueByMonthWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue by Month (2025)';

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $propertyId = auth()->user()->property_id;

        if (!$propertyId) {
            return ['datasets' => [], 'labels' => []];
        }

        $year = 2025;
        $data = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('M', mktime(0, 0, 0, $month, 1));

            $revenue = Payment::whereHas('bookings', fn($q) => $q->where('property_id', $propertyId))
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
                    'backgroundColor' => 'rgba(34, 197, 94, 0.6)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
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
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
