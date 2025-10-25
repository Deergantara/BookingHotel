<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Property;
use Filament\Widgets\ChartWidget;

class AdminHotelBookingStatusWidget extends ChartWidget
{
    protected static ?string $heading = 'Booking Status (This Month)';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');

        $thisMonth = now()->month;
        $thisYear = now()->year;

        // Hitung booking per status
        $completed = Booking::whereIn('property_id', $propertyIds)
            ->where('status', 'completed')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        $confirmed = Booking::whereIn('property_id', $propertyIds)
            ->where('status', 'confirmed')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        $checkedIn = Booking::whereIn('property_id', $propertyIds)
            ->where('status', 'checked_in')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        $cancelled = Booking::whereIn('property_id', $propertyIds)
            ->where('status', 'cancelled')
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        // Note: Tidak ada status 'no_show' di migration, jadi skip

        return [
            'datasets' => [
                [
                    'label' => 'Booking Status',
                    'data' => [$completed, $confirmed, $checkedIn, $cancelled],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',   // Green - Completed
                        'rgb(59, 130, 246)',  // Blue - Confirmed
                        'rgb(251, 191, 36)',  // Yellow - Checked In
                        'rgb(239, 68, 68)',   // Red - Cancelled
                    ],
                ],
            ],
            'labels' => ['Completed', 'Confirmed', 'Checked In', 'Cancelled'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
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
