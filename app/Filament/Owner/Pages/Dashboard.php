<?php

namespace App\Filament\Owner\Pages;

use App\Filament\Owner\Widgets\GrossAmountWidget;
use App\Filament\Owner\Widgets\MonthlyBookingTrendWidget;
use App\Filament\Owner\Widgets\NetAmountWidget;
use App\Filament\Owner\Widgets\OccupancyRateWidget;
use App\Filament\Owner\Widgets\PaymentStatusChartWidget;
use App\Filament\Owner\Widgets\RevenueChartWidget;
use App\Filament\Owner\Widgets\TopHotelsChartWidget;
use App\Filament\Owner\Widgets\TotalBookingWidget;
use App\Filament\Owner\Widgets\TotalDiscountWidget;
use App\Filament\Owner\Widgets\TotalHotelWidget;
use App\Filament\Owner\Widgets\TotalPropertyWidget;
use App\Filament\Owner\Widgets\TotalRevenueWidget;
use App\Filament\Owner\Widgets\TotalUsersWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.owner.pages.dashboard';

    // public function getWidgets(): array
    // {
    //     return [
    //         TotalRevenueWidget::class,
    //         TotalHotelWidget::class,
    //         TotalPropertyWidget::class,
    //         TotalBookingWidget::class,
    //         TotalUsersWidget::class,
    //         OccupancyRateWidget::class,
    //         RevenueChartWidget::class,
    //         TopHotelsChartWidget::class,
    //         MonthlyBookingTrendWidget::class,
    //         PaymentStatusChartWidget::class,
    //         GrossAmountWidget::class,
    //         TotalDiscountWidget::class,
    //         NetAmountWidget::class,
    //     ];
    // }

    // public function getColumns(): int | string | array
    // {
    //     return 3;
    // }
}
