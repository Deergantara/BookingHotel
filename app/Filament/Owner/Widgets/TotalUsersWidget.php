<?php

namespace App\Filament\Owner\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalUsersWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();

        return [
            Stat::make('Total Pengguna Aplikasi', $totalUsers)
                ->description('Seluruh akun terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->chart([5, 10, 15, 20, 25, 30, 35, 40])
        ];
    }

    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 1;
}
