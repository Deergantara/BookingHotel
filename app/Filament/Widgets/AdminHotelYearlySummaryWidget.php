<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use App\Models\Property;
use Filament\Widgets\Widget;

class AdminHotelYearlySummaryWidget extends Widget
{
    protected static string $view = 'filament.widgets.admin-hotel-yearly-summary-widget';

    protected int | string | array $columnSpan = 'full';

    public function getSummary()
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');

        $year = 2025;

        // Total Revenue
        $totalRevenue = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                $q->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereYear('paid_at', $year)
            ->sum('price');

        // Tax Collected (10% dari revenue)
        $taxCollected = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                $q->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereYear('paid_at', $year)
            ->sum('tax');

        // Net Revenue (Total - Tax)
        $netRevenue = $totalRevenue - $taxCollected;

        return [
            'total_revenue' => $totalRevenue,
            'tax_collected' => $taxCollected,
            'net_revenue' => $netRevenue,
            'year' => $year,
        ];
    }
}
