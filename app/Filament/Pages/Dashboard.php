<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $title = 'Dashboard Admin System';

    protected static string $routePath = '/';

    // Tambahkan konten dashboard di sini
    protected function getHeaderWidgets(): array
    {
        return [
            // Widget-widget Anda di sini
            // Contoh: StatsOverviewWidget::class,
        ];
    }
}
