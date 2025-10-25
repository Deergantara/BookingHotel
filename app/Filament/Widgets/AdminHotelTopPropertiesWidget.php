<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class AdminHotelTopPropertiesWidget extends BaseWidget
{
    protected static ?string $heading = 'Top 5 Properties (Most Bookings)';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $user = auth()->user();
        $hotelId = $user->hotel_id;

        return $table
            ->query(
                Property::where('hotel_id', $hotelId)
                    ->withCount('bookings')
                    ->orderBy('bookings_count', 'desc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('rank')
                    ->label('#')
                    ->getStateUsing(fn ($rowLoop) => $rowLoop->iteration),

                Tables\Columns\TextColumn::make('name')
                    ->label('Property Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->searchable(),

                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('Total Bookings')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('bintang')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) . ' ⭐' : 'N/A'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->paginated(false);
    }
}
