<?php

namespace App\Filament\Resources\PropertyStaffResource\Pages;

use App\Filament\Resources\PropertyStaffResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewPropertyStaff extends ViewRecord
{
    protected static string $resource = PropertyStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Staff')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->size('lg')
                            ->weight('bold')
                            ->icon('heroicon-m-user')
                            ->iconColor('primary'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('phone')
                            ->label('Telepon')
                            ->icon('heroicon-m-phone')
                            ->copyable()
                            ->placeholder('-'),

                        Infolists\Components\TextEntry::make('role')
                            ->label('Role')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'admin property' => 'info',
                                'resepsionis' => 'warning',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'admin property' => 'Admin Property',
                                'resepsionis' => 'Resepsionis',
                                default => $state,
                            }),

                        Infolists\Components\TextEntry::make('property.name')
                            ->label('Property')
                            ->icon('heroicon-m-building-office')
                            ->iconColor('success'),

                        Infolists\Components\TextEntry::make('property.city')
                            ->label('Lokasi Property')
                            ->formatStateUsing(fn ($record) =>
                                $record->property ?
                                $record->property->city . ', ' . $record->property->area :
                                '-'
                            )
                            ->icon('heroicon-m-map-pin'),

                        Infolists\Components\TextEntry::make('nomor_identitas')
                            ->label('Nomor Identitas')
                            ->placeholder('-'),

                        Infolists\Components\TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->date('d M Y')
                            ->placeholder('-'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Tanggal Registrasi')
                            ->dateTime('d M Y, H:i')
                            ->icon('heroicon-m-calendar'),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Terakhir Diupdate')
                            ->dateTime('d M Y, H:i')
                            ->since()
                            ->icon('heroicon-m-clock'),
                    ])
                    ->columns(2),
            ]);
    }
}
