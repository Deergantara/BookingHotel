<?php

namespace App\Providers\Filament;

use App\Filament\Owner\Pages\Dashboard;
use App\Filament\Owner\Pages\HotelList;
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
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OwnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('owner')
            ->path('owner')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->authGuard('web')
            ->pages([
                Dashboard::class,
                HotelList::class,
            ])
            ->widgets([
                TotalRevenueWidget::class,
                TotalHotelWidget::class,
                TotalPropertyWidget::class,
                TotalBookingWidget::class,
                TotalUsersWidget::class,
                OccupancyRateWidget::class,
                RevenueChartWidget::class,
                TopHotelsChartWidget::class,
                MonthlyBookingTrendWidget::class,
                PaymentStatusChartWidget::class,
                GrossAmountWidget::class,
                TotalDiscountWidget::class,
                NetAmountWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
