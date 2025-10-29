<?php

namespace App\Providers\Filament;

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

class OwnerHotelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('owner-hotel')
            ->path('owner-hotel')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->brandName('Owner Hotel Panel')
            ->discoverResources(in: app_path('Filament/OwnerHotel/Resources'), for: 'App\\Filament\\OwnerHotel\\Resources')
            ->discoverPages(in: app_path('Filament/OwnerHotel/Pages'), for: 'App\\Filament\\OwnerHotel\\Pages')
            ->pages([
                \App\Filament\OwnerHotel\Pages\Dashboard::class, // ✅ Pastikan class ini ada
            ])
            ->discoverWidgets(in: app_path('Filament/OwnerHotel/Widgets'), for: 'App\\Filament\\OwnerHotel\\Widgets')
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
            ])
            ->authGuard('web');
    }
}