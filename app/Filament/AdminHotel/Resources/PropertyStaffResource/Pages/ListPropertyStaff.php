<?php

namespace App\Filament\Resources\PropertyStaffResource\Pages;

use App\Filament\AdminHotel\Resources\PropertyStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPropertyStaff extends ListRecords
{
    protected static string $resource = PropertyStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Staff')
                ->icon('heroicon-o-plus'),
        ];
    }

    // ✅ Tabs untuk filter cepat by role
    public function getTabs(): array
    {
        $user = auth()->user();
        $propertyIds = \App\Models\Property::where('hotel_id', $user->hotel_id)->pluck('id');

        return [
            'all' => Tab::make('Semua Staff')
                ->badge(fn () => \App\Models\User::whereIn('role', ['admin property', 'resepsionis'])
                    ->whereIn('property_id', $propertyIds)
                    ->count()),

            'admin_property' => Tab::make('Admin Property')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'admin property'))
                ->badge(fn () => \App\Models\User::where('role', 'admin property')
                    ->whereIn('property_id', $propertyIds)
                    ->count())
                ->badgeColor('info'),

            'resepsionis' => Tab::make('Resepsionis')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'resepsionis'))
                ->badge(fn () => \App\Models\User::where('role', 'resepsionis')
                    ->whereIn('property_id', $propertyIds)
                    ->count())
                ->badgeColor('warning'),
        ];
    }
}
