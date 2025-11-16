<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PaymentStatusChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Status Transaksi Payment';

    protected static ?int $sort = 10;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $statuses = Payment::select('transaction_status', DB::raw('COUNT(*) as total'))
            ->groupBy('transaction_status')
            ->get();

        $labels = [];
        $data = [];
        $colors = [
            'pending' => '#f59e0b',
            'settlement' => '#10b981',
            'cancel' => '#ef4444',
            'expire' => '#6b7280',
            'deny' => '#dc2626',
        ];

        $backgroundColors = [];

        foreach ($statuses as $status) {
            $labels[] = ucfirst($status->transaction_status);
            $data[] = $status->total;
            $backgroundColors[] = $colors[$status->transaction_status] ?? '#3b82f6';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Transaksi',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
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
                'display' => true,
                'position' => 'bottom',
            ],
        ],
    ];
}

    protected function getType(): string
    {
        return 'doughnut';
    }
}
