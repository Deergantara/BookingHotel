<?php

namespace App\Filament\OwnerHotel\Widgets;

use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminHotelStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        if (!$hotelId) {
            return [
                Stat::make('Error', 'User tidak memiliki hotel assigned')
                    ->description('Hubungi administrator')
                    ->color('danger'),
            ];
        }

        $today = today();
        $thisMonth = now()->month;
        $thisYear = now()->year;

        // Ambil semua property_id milik hotel ini
        $propertyIds = Property::where('hotel_id', $hotelId)->pluck('id');

        // 1. Booking Hari Ini
        $bookingsToday = Booking::whereIn('property_id', $propertyIds)
            ->whereDate('created_at', $today)
            ->count();

        // 2. Booking Bulan Ini
        $bookingsThisMonth = Booking::whereIn('property_id', $propertyIds)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        // 3. Total Properties
        $totalProperties = Property::where('hotel_id', $hotelId)->count();

        // 4. Total Staff (Resepsionis + Admin Property dari properties hotel ini)
        $totalStaff = User::whereIn('property_id', $propertyIds)
            ->whereIn('role', ['resepsionis', 'admin property'])
            ->count();

        // 5. Revenue Hari Ini
        $revenueToday = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                $q->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereDate('paid_at', $today)
            ->sum('price');

        // 6. Revenue Bulan Ini
        $revenueThisMonth = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                $q->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereMonth('paid_at', $thisMonth)
            ->whereYear('paid_at', $thisYear)
            ->sum('price');

        // 7. Revenue Tahun Ini
        $revenueThisYear = Payment::whereHas('bookings', function($q) use ($propertyIds) {
                $q->whereIn('property_id', $propertyIds);
            })
            ->where('transaction_status', 'settlement')
            ->whereYear('paid_at', $thisYear)
            ->sum('price');

        return [
            Stat::make('Booking Hari Ini', $bookingsToday)
                ->description('Total booking masuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                ->chart($this->getBookingTrendLast7Days($propertyIds)),

            Stat::make('Booking Bulan Ini', $bookingsThisMonth)
                ->description('Total booking bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Total Properties', $totalProperties)
                ->description('Properties yang dimiliki')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),

            Stat::make('Total Staff', $totalStaff)
                ->description('Resepsionis & Admin Property')
                ->descriptionIcon('heroicon-m-users')
                ->color('gray'),

            Stat::make('Revenue Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description('Pendapatan hari ini')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Revenue Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Pendapatan bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Revenue Tahun Ini', 'Rp ' . number_format($revenueThisYear, 0, ',', '.'))
                ->description('Pendapatan tahun ' . $thisYear)
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),
        ];
    }

    private function getBookingTrendLast7Days($propertyIds): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $data[] = Booking::whereIn('property_id', $propertyIds)
                ->whereDate('created_at', $date)
                ->count();
        }
        return $data;
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
