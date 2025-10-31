<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Kamar;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopRoomsWidget extends BaseWidget
{
    protected static ?string $heading = 'Top 5 Most Booked Rooms (This Year)';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $propertyId = auth()->user()->property_id;

        return $table
            ->query(
                Kamar::query()
                    ->whereHas('tipeKamar', fn($q) => $q->where('property_id', $propertyId))
                    ->withCount([
                        'bookings' => fn($query) => $query->whereYear('created_at', now()->year)
                    ])
                    ->orderBy('bookings_count', 'desc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->state(function ($rowLoop) {
                        return $rowLoop->iteration;
                    }),

                Tables\Columns\TextColumn::make('nomor_kamar')
                    ->label('Room Number')
                    ->weight('bold')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipeKamar.nama_tipe')
                    ->label('Room Type')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tipeKamar.harga')
                    ->label('Price/Night')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('Total Bookings')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tersedia' => 'success',
                        'dipesan' => 'info',
                        'ditempati' => 'warning',
                        'perbaikan' => 'danger',
                    }),
            ])
            ->paginated(false);
    }
}
