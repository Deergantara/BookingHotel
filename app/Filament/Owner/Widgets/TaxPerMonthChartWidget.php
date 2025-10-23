<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;

class TaxPerMonthChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Pajak Per Bulan (Tahun Ini)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $year = now()->year;
        $data = [];
        $labels = [];

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('F', mktime(0, 0, 0, $month, 1));
            
            $tax = Payment::where('transaction_status', 'settlement')
                ->whereYear('paid_at', $year)
                ->whereMonth('paid_at', $month)
                ->sum('tax');
            
            $data[] = $tax;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pajak (Rp)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.5)',
                    'borderColor' => 'rgb(239, 68, 68)',
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