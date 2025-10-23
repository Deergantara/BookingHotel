<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class OwnerStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $today = today();

        $thisMonth = now()->month;
        $thisYear = now()->year;

        // 1. Hotel terdaftar bulan ini
        $hotelsThisMonth = Hotel::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        // 2. Booking hari ini
        $BookingsToday = Booking::whereDate('created_at', $today)->count();

        // 3. Booking bulan ini
        $BookingsThisMonth = Booking::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->count();

        // 4. Pendapatan hari ini (hanya yang settlement)
        $revenueToday = Payment::where('transaction_status', 'settlement')
            ->whereDate('paid_at', $today)
            ->sum('price');

        // 5. Pendapatan bulan ini
        $revenueThisMonth = Payment::where('transaction_status', 'settlement')
            ->whereMonth('paid_at', $thisMonth)
            ->whereYear('paid_at', $thisYear)
            ->sum('price');

        // 6. Total pendapatan tahunan
        $revenueThisYear = Payment::where('transaction_status', 'settlement')
            ->whereYear('paid_at', $thisYear)
            ->sum('price');

        // 7. Total pajak tahunan (asumsi pajak 10% dari price)
        $taxThisYear = Payment::where('transaction_status', 'settlement')
            ->whereYear('paid_at', $thisYear)
            ->sum('tax');

        // 8. Total hotel tahunan
        $hotelsThisYear = Hotel::whereYear('created_at', $thisYear)->count();

        return [
            // Row 1: Hari Ini
            Stat::make('Booking Hari Ini', $BookingsToday)
                ->description('Total Booking masuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                ->chart($this->getBookingTrendLast7Days()),

            Stat::make('Booking Bulan Ini', $BookingsThisMonth)
                ->description('Total Booking bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),

            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description('Revenue dari pembayaran hari ini')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            // Row 2: Bulan Ini
            

            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Revenue bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            // Row 3: Hotel
            Stat::make('Hotel Baru Bulan Ini', $hotelsThisMonth)
                ->description('Hotel terdaftar bulan ' . now()->format('F'))
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning'),

            Stat::make('Total Hotel ' . $thisYear, $hotelsThisYear)
                ->description('Hotel terdaftar tahun ini')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('gray'),

            // Row 4: Tahunan
            Stat::make('Total Pendapatan Tahunan', 'Rp ' . number_format($revenueThisYear, 0, ',', '.'))
                ->description('Total revenue tahun ' . $thisYear)
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),

            Stat::make('Total Pajak Tahunan', 'Rp ' . number_format($taxThisYear, 0, ',', '.'))
                ->description('Total pajak tahun ' . $thisYear)
                ->descriptionIcon('heroicon-m-receipt-percent')
                ->color('danger'),
        ];
    }

    // Helper: Trend Booking 7 hari terakhir untuk mini chart
    private function getBookingTrendLast7Days(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $data[] = Booking::whereDate('created_at', $date)->count();
        }
        return $data;
    }

    protected function getColumns(): int
    {
        return 4; // 4 columns layout
    }
}