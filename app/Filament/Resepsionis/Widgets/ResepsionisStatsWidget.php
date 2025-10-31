<?php

namespace App\Filament\Resepsionis\Widgets;

use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResepsionisStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $propertyId = $user->property_id;

        if (!$propertyId) {
            return [
                Stat::make('Error', 'Property tidak ditemukan')
                    ->description('Hubungi administrator')
                    ->color('danger'),
            ];
        }

        $today = today();

        // 1. Today's Check-in
        $todayCheckIns = Booking::where('property_id', $propertyId)
            ->whereDate('checkin_date', $today)
            ->where('status', 'confirmed')
            ->count();

        // 2. Today's Check-out
        $todayCheckOuts = Booking::where('property_id', $propertyId)
            ->whereDate('checkout_date', $today)
            ->where('status', 'checked_in')
            ->count();

        // 3. Current Guests (yang sedang checked in)
        $currentGuests = Booking::where('property_id', $propertyId)
            ->where('status', 'checked_in')
            ->count();

        // 4. Available Rooms
        $availableRooms = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->where('status', 'tersedia')
            ->count();

        // 5. Total Rooms
        $totalRooms = Kamar::whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
            ->count();

        // 6. Pending Payments
        $pendingPayments = Booking::where('property_id', $propertyId)
            ->whereHas('payment', fn($q) => $q->where('transaction_status', 'pending'))
            ->orWhereDoesntHave('payment')
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->count();

        return [
            Stat::make("Today's Check-in", $todayCheckIns)
                ->description('Tamu yang akan check-in hari ini')
                ->descriptionIcon('heroicon-m-arrow-right-on-rectangle')
                ->color('success')
                ->chart([3, 5, 7, 9, 8, 6, 7]), // Dummy chart

            Stat::make("Today's Check-out", $todayCheckOuts)
                ->description('Tamu yang akan check-out hari ini')
                ->descriptionIcon('heroicon-m-arrow-left-on-rectangle')
                ->color('warning')
                ->chart([7, 6, 8, 9, 7, 5, 3]),

            Stat::make('Current Guests', $currentGuests)
                ->description('Tamu yang sedang menginap')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Available Rooms', $availableRooms)
                ->description('Kamar tersedia')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Rooms', $totalRooms)
                ->description('Total semua kamar')
                ->descriptionIcon('heroicon-m-home')
                ->color('gray'),

            Stat::make('Pending Payments', $pendingPayments)
                ->description('Pembayaran yang belum lunas')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
