<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Kamar;
use Filament\Widgets\ChartWidget;

class RoomStatusWidget extends ChartWidget
{
    protected static ?string $heading = 'Room Status Distribution';

    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $propertyId = auth()->user()->property_id;

        if (!$propertyId) {
            return ['datasets' => [], 'labels' => []];
        }

        $available = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'tersedia')
            ->count();

        $occupied = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'ditempati')
            ->count();

        $booked = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'dipesan')
            ->count();

        $maintenance = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'perbaikan')
            ->count();

        return [
            'datasets' => [
                [
                    'data' => [$available, $occupied, $booked, $maintenance],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',   // Available - green
                        'rgb(251, 146, 60)',  // Occupied - orange
                        'rgb(59, 130, 246)',  // Booked - blue
                        'rgb(239, 68, 68)',   // Maintenance - red
                    ],
                ],
            ],
            'labels' => ['Available', 'Occupied', 'Booked', 'Maintenance'],
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
