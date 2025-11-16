<?php

namespace App\Filament\Owner\Resources\PropertyResource\Pages;

use App\Filament\Owner\Resources\PropertyResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class ViewProperty extends ViewRecord
{
    protected static string $resource = PropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Foto Property')
                    ->schema([
                        ImageEntry::make('foto')
                            ->label('')
                            ->hidden(fn ($record) => empty($record->foto))
                            ->getStateUsing(function ($record) {
                                return $record->foto ?? [];
                            })
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Informasi Property')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Property')
                            ->size('lg')
                            ->weight('bold'),

                        TextEntry::make('hotel.nama')
                            ->label('Hotel')
                            ->icon('heroicon-o-building-office-2'),

                        TextEntry::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),

                        TextEntry::make('city')
                            ->label('Kota')
                            ->icon('heroicon-o-map-pin'),

                        TextEntry::make('area')
                            ->label('Area'),

                        TextEntry::make('contact')
                            ->label('Kontak')
                            ->icon('heroicon-o-phone')
                            ->copyable(),

                        TextEntry::make('bintang')
                            ->label('Rating')
                            ->formatStateUsing(fn ($state) => number_format($state, 1) . ' ⭐')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('is_active')
                            ->label('Status')
                            ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Nonaktif')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'danger'),
                    ])
                    ->columns(2),

                Section::make('Informasi Kamar')
                    ->schema([
                        TextEntry::make('jumlah_kamar')
                            ->label('Total Kamar'),

                        TextEntry::make('kapasitas_tamu')
                            ->label('Kapasitas Tamu'),

                        TextEntry::make('available_from')
                            ->label('Tersedia Dari')
                            ->date('d F Y'),

                        TextEntry::make('available_to')
                            ->label('Tersedia Sampai')
                            ->date('d F Y'),
                    ])
                    ->columns(2),

                Section::make('Fasilitas')
                    ->schema([
                        RepeatableEntry::make('fasilitas')
                            ->label('')
                            ->schema([
                                TextEntry::make('nama')
                                    ->label('')
                                    ->icon('heroicon-o-check-circle')
                                    ->color('success'),
                            ])
                            ->columns(3)
                            ->hidden(fn ($record) => $record->fasilitas->isEmpty()),
                    ])
                    ->collapsible(),

                Section::make('Statistik')
                    ->schema([
                        TextEntry::make('tipeKamars_count')
                            ->label('Total Tipe Kamar')
                            ->state(fn ($record) => $record->tipeKamars()->count())
                            ->badge()
                            ->color('info'),

                        TextEntry::make('bookings_count')
                            ->label('Total Booking')
                            ->state(fn ($record) => $record->bookings()->count())
                            ->badge()
                            ->color('success'),

                        TextEntry::make('reviews_count')
                            ->label('Total Review')
                            ->state(fn ($record) => $record->reviews()->count())
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('average_rating')
                            ->label('Rating Rata-rata')
                            ->state(fn ($record) => number_format($record->reviews()->avg('star') ?? 0, 1))
                            ->badge()
                            ->color('warning')
                            ->icon('heroicon-o-star'),
                    ])
                    ->columns(4),

                Section::make('Informasi Sistem')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d F Y, H:i'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diupdate')
                            ->dateTime('d F Y, H:i'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}
