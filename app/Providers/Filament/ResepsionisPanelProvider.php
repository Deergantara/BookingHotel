<?php

namespace App\Providers\Filament;

use App\Filament\Resources\ProfileResource;
use App\Http\Middleware\EnsureUserIsResepsionis; // ✅ ini yang bena
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\UserMenuItem;
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
use Illuminate\Support\Facades\Auth;

class ResepsionisPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('resepsionis')
            ->path('resepsionis')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resepsionis/Resources'), for: 'App\\Filament\\Resepsionis\\Resources')
            ->discoverPages(in: app_path('Filament/Resepsionis/Pages'), for: 'App\\Filament\\Resepsionis\\Pages')
            ->pages([
                \App\Filament\Resepsionis\Pages\Dashboard::class, // ✅ panggil dashboard resepsionis kamu
            ])            
            ->discoverWidgets(in: app_path('Filament/Resepsionis/Widgets'), for: 'App\\Filament\\Resepsionis\\Widgets')
            ->widgets([
                // Widgets khusus resepsionis
            ])

            ->userMenuItems([
                'profile' => UserMenuItem::make()
                    ->label('Edit Profile')
                    ->url(fn (): string => ProfileResource::getUrl('edit', ['record' => Auth::id()]))
                    ->icon('heroicon-o-user'),
            ])

            ->middleware([
                EnsureUserIsResepsionis::class,
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
                EnsureUserIsResepsionis::class, // ← TAMBAHKAN
            ])
            ->authGuard('web');
    }
}
