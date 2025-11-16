<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Property';

    protected static ?string $modelLabel = 'Property';

    protected static ?string $pluralModelLabel = 'Properties';

    protected static ?string $navigationGroup = 'Data Hotel';

    protected static ?int $navigationSort = 1;

    // Owner hanya bisa view, tidak bisa create/edit/delete
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    // Filter hanya property milik hotel owner
    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $hotelId = $user->hotel_id ?? null;

        return parent::getEloquentQuery()->where('hotel_id', $hotelId);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form disabled karena read-only
                Forms\Components\Placeholder::make('info')
                    ->content('Anda hanya dapat melihat data property. Untuk perubahan data, hubungi admin.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/no-image.png'))
                    ->getStateUsing(function ($record) {
                        $fotos = $record->foto;
                        return is_array($fotos) && count($fotos) > 0 ? $fotos[0] : null;
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Property')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('city')
                    ->label('Kota')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-o-map-pin'),

                Tables\Columns\TextColumn::make('area')
                    ->label('Area')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('bintang')
                    ->label('Rating')
                    ->sortable()
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-star')
                    ->formatStateUsing(fn ($state) => number_format($state, 1) . ' ⭐'),

                Tables\Columns\TextColumn::make('jumlah_kamar')
                    ->label('Jumlah Kamar')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('tipeKamars_count')
                    ->label('Tipe Kamar')
                    ->counts('tipeKamars')
                    ->badge()
                    ->color('primary')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('Total Booking')
                    ->counts('bookings')
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city')
                    ->label('Kota')
                    ->options(function () {
                        $user = Auth::user();
                        $hotelId = $user->hotel_id ?? null;
                        return Property::where('hotel_id', $hotelId)
                            ->distinct()
                            ->pluck('city', 'city');
                    })
                    ->searchable(),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->placeholder('Semua')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // No bulk actions for owner
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'view' => Pages\ViewProperty::route('/{record}'),
        ];
    }
}
