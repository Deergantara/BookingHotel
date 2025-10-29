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

class AdminHotelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin-hotel')
            ->path('admin-hotel')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->brandName('Admin Hotel Panel')
            ->discoverResources(in: app_path('Filament/AdminHotel/Resources'), for: 'App\\Filament\\AdminHotel\\Resources')
            ->discoverPages(in: app_path('Filament/AdminHotel/Pages'), for: 'App\\Filament\\AdminHotel\\Pages')
            ->pages([
                \App\Filament\AdminHotel\Pages\Dashboard::class, // ✅ Pastikan class ini ada
            ])
            ->discoverWidgets(in: app_path('Filament/AdminHotel/Widgets'), for: 'App\\Filament\\AdminHotel\\Widgets')
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