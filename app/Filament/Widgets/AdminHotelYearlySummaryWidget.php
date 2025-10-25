<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\Property;
use Filament\Widgets\Widget;

class AdminHotelYearlySummaryWidget extends Widget
{
    protected static string $view = 'filament.widgets.admin-hotel-yearly-summary-widget';

    protected int | string | array $columnSpan = 'full';

    public function getSummaryData(): array
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;
        
        if (!$hotelId) {
            return [
                'totalRevenue' => 0,
                'taxCollected' => 0,
                'netRevenue' => 0,
            ];
        }

        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');
        $year = 2025;

        $totalRevenue = Payment::whereHas('bookings', function($query) use ($propertyIds) {
                $query->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereYear('paid_at', $year)
            ->sum('price');

        $taxCollected = Payment::whereHas('bookings', function($query) use ($propertyIds) {
                $query->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereYear('paid_at', $year)
            ->sum('tax');

        $netRevenue = $totalRevenue - $taxCollected;

        return [
            'totalRevenue' => $totalRevenue,
            'taxCollected' => $taxCollected,
            'netRevenue' => $netRevenue,
        ];
    }
}