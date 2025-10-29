<?php

namespace App\Filament\OwnerHotel\Resources\PropertyResource\Pages;

use App\Filament\OwnerHotel\Resources\PropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewProperty extends ViewRecord
{
    protected static string $resource = PropertyResource::class;

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
                Infolists\Components\Section::make('Informasi Property')
                    ->schema([
                        Infolists\Components\ImageEntry::make('foto')
                            ->label('Foto')
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('name')
                            ->label('Nama Property')
                            ->size('lg')
                            ->weight('bold')
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('address')
                            ->label('Alamat')
                            ->icon('heroicon-m-map-pin')
                            ->columnSpanFull(),

                        Infolists\Components\TextEntry::make('city')
                            ->label('Kota'),

                        Infolists\Components\TextEntry::make('area')
                            ->label('Area'),

                        Infolists\Components\TextEntry::make('contact')
                            ->label('Kontak')
                            ->icon('heroicon-m-phone')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('bintang')
                            ->label('Rating')
                            ->suffix(' ⭐'),

                        Infolists\Components\TextEntry::make('jumlah_kamar')
                            ->label('Jumlah Kamar')
                            ->badge()
                            ->color('info'),

                        Infolists\Components\TextEntry::make('kapasitas_tamu')
                            ->label('Kapasitas Tamu')
                            ->suffix(' tamu'),

                        Infolists\Components\TextEntry::make('available_from')
                            ->label('Tersedia Dari')
                            ->date('d M Y'),

                        Infolists\Components\TextEntry::make('available_to')
                            ->label('Tersedia Sampai')
                            ->date('d M Y'),

                        Infolists\Components\TextEntry::make('fasilitas')
                            ->label('Fasilitas')
                            ->columnSpanFull(),

                        Infolists\Components\IconEntry::make('is_active')
                            ->label('Status')
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                    ])
                    ->columns(2),
            ]);
    }
}