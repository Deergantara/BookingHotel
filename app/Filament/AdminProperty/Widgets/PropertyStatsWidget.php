<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\TipeKamar;
use App\Models\Payment;
use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PropertyStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $propertyId = auth()->user()->property_id;

        if (!$propertyId) {
            return [];
        }

        $today = today();
        $thisMonth = now()->month;
        $thisYear = now()->year;

        // 1. Booking hari ini
        $bookingsToday = Booking::where('property_id', $propertyId)
            ->whereDate('created_at', $today)
            ->count();

        // 2. Booking bulan ini
        $bookingsThisMonth = Booking::where('property_id', $propertyId)
            ->whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        // 3. Total kamar
        $totalRooms = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))->count();

        // 4. Rating rata-rata
        $avgRating = Review::where('property_id', $propertyId)->avg('star') ?? 5.0;

        // 5. Revenue hari ini
        $revenueToday = Payment::whereHas('bookings', fn($q) => $q->where('property_id', $propertyId))
            ->where('transaction_status', 'settlement')
            ->whereDate('paid_at', $today)
            ->sum('price');

        // 6. Revenue bulan ini
        $revenueThisMonth = Payment::whereHas('bookings', fn($q) => $q->where('property_id', $propertyId))
            ->where('transaction_status', 'settlement')
            ->whereMonth('paid_at', $thisMonth)
            ->whereYear('paid_at', $thisYear)
            ->sum('price');

        // 7. Available rooms
        $availableRooms = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'tersedia')
            ->count();

        // 8. Occupied rooms
        $occupiedRooms = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'ditempati')
            ->count();

        // 9. Occupancy rate
        $occupancyRate = $totalRooms > 0 ? ($occupiedRooms / $totalRooms) * 100 : 0;

        return [
            Stat::make('Booking Hari Ini', $bookingsToday)
                ->description('Total booking masuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Booking Bulan Ini', $bookingsThisMonth)
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Total Kamar', $totalRooms)
                ->description('Semua kamar property')
                ->descriptionIcon('heroicon-m-home')
                ->color('warning'),

            Stat::make('Rating Rata-rata', number_format($avgRating, 1) . ' ⭐')
                ->description('Dari reviews tamu')
                ->descriptionIcon('heroicon-m-star')
                ->color('success'),

            Stat::make('Revenue Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description('Pendapatan hari ini')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Revenue Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description(now()->format('F Y'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Available Rooms', $availableRooms)
                ->description('Kamar tersedia')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Occupied Rooms', $occupiedRooms)
                ->description('Kamar ditempati')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make('Occupancy Rate', number_format($occupancyRate, 1) . '%')
                ->description('Tingkat hunian')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($occupancyRate > 70 ? 'success' : 'warning'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
