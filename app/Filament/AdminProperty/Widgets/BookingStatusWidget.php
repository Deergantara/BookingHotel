<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingStatusWidget extends ChartWidget
{
    protected static ?string $heading = 'Booking Status (This Month)';

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $propertyId = auth()->user()->property_id;

        if (!$propertyId) {
            return ['datasets' => [], 'labels' => []];
        }

        $thisMonth = now()->month;
        $thisYear = now()->year;

        $completed = Booking::where('property_id', $propertyId)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->where('status', 'completed')
            ->count();

        $confirmed = Booking::where('property_id', $propertyId)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->where('status', 'confirmed')
            ->count();

        $checkedIn = Booking::where('property_id', $propertyId)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->where('status', 'checked_in')
            ->count();

        $cancelled = Booking::where('property_id', $propertyId)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->where('status', 'cancelled')
            ->count();

        return [
            'datasets' => [
                [
                    'data' => [$completed, $confirmed, $checkedIn, $cancelled],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)',
                        'rgb(251, 146, 60)',
                        'rgb(239, 68, 68)',
                    ],
                ],
            ],
            'labels' => ['Completed', 'Confirmed', 'Checked In', 'Cancelled'],
        ];
    } // ← ini tadi yang hilang

    protected function getType(): string
    {
        return 'pie';
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
}
