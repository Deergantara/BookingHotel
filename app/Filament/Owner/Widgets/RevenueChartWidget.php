<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan Aplikasi (Tax + Service Charge)';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Payment::where('transaction_status', 'settlement')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(tax) as total_tax')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $revenue = array_fill(0, 12, 0);

        foreach ($data as $item) {
            $revenue[$item->month - 1] = $item->total_tax;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (Rp)',
                    'data' => $revenue,
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#10b981',
                ],
            ],
            'labels' => $months,
        ];
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
                'ticks' => [
                    'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                ],
            ],
        ],
    ];
}

    protected function getType(): string
    {
        return 'line';
    }
}
