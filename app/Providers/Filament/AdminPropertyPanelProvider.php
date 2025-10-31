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

class AdminPropertyPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin-property')
            ->path('admin-property')
            ->login()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->brandName('Admin Property Panel')
            ->favicon(asset('favicon.ico'))
            ->discoverResources(in: app_path('Filament/AdminProperty/Resources'), for: 'App\\Filament\\AdminProperty\\Resources')
            ->discoverPages(in: app_path('Filament/AdminProperty/Pages'), for: 'App\\Filament\\AdminProperty\\Pages')
            ->pages([
                \App\Filament\AdminProperty\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/AdminProperty/Widgets'), for: 'App\\Filament\\AdminProperty\\Widgets')
            ->navigationGroups([
                'Main',
                'Booking Management',
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
            \App\Http\Middleware\EnsureUserIsAdminProperty::class,
            ])
            ->authGuard('web');
    }
}
