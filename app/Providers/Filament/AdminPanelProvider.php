<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
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
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
    ->default()
    ->id('admin')
    ->path('admin')
    ->login()
    ->colors([
        'primary' => Color::Amber,
    ])
    ->brandName('Admin System Panel')

    // ONLY RESOURCES
    ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')

    // REMOVE discoverPages because folder does not exist anymore
    // ->discoverPages(...)

    // REMOVE discoverWidgets because folder does not exist
    // ->discoverWidgets(...)

    // Your custom pages only
    ->pages([
    \App\Filament\Admin\Pages\Dashboard::class,
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
    ->authGuard('web')
    ->userMenuItems([
        'profile' => UserMenuItem::make()
            ->label('Edit Profile')
            ->url(fn (): string => url('/admin/profile/' . Auth::id() . '/edit'))
            ->icon('heroicon-o-user'),
    ]);
    }
}
