<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard; // ✅ BENAR

class Dashboard extends BaseDashboard
{
    protected static string $routePath = '/';
    protected static ?string $title = 'Dashboard Admin System';
}
