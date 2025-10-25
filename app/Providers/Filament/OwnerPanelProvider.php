<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ProfileResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\UserMenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Auth;

class OwnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('owner')
            ->path('owner')
            ->login() // <— ini penting untuk form login!
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Owner/Resources'), for: 'App\\Filament\\Owner\\Resources')
            ->discoverPages(in: app_path('Filament/Owner/Pages'), for: 'App\\Filament\\Owner\\Pages')
            ->pages([
                \App\Filament\Owner\Pages\OwnerSystemDashboard::class,
            ])                                 
            ->discoverWidgets(in: app_path('Filament/Owner/Widgets'), for: 'App\\Filament\\Owner\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])

            ->userMenuItems([
                'profile' => UserMenuItem::make()
                    ->label('Edit Profile')
                    ->url(fn (): string => url('/owner/profile/' . Auth::id() . '/edit'))
                    ->icon('heroicon-o-user'),
            ]);
            
    }
}
