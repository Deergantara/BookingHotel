<?php

namespace App\Filament\AdminProperty\Resources;

use App\Filament\AdminProperty\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Reviews';

    protected static ?string $navigationGroup = 'Booking Management';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin property';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('property_id', auth()->user()->property_id)
            ->with(['user']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Review Details')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Nama Reviewer')
                            ->disabled(),

                        Forms\Components\TextInput::make('booking_number')
                            ->label('Nomor Booking')
                            ->placeholder('BKG-YYYYMMDD-001')
                            ->disabled(),

                        Forms\Components\TextInput::make('star')
                            ->label('Rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->suffix('⭐')
                            ->disabled(),

                        Forms\Components\Textarea::make('comment')
                            ->label('Isi Review')
                            ->rows(5)
                            ->columnSpanFull()
                            ->disabled(),

                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Review At')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Reviewer')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-m-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->getStateUsing(fn ($record) => 'BKG-' . $record->created_at->format('Ymd') . '-' . str_pad($record->id, 3, '0', STR_PAD_LEFT))
                    ->searchable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('star')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', (int)$state))
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('comment')
                    ->label('Review')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->comment)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Review At')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->description(fn ($record) => $record->created_at->diffForHumans()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('star')
                    ->label('Rating')
                    ->options([
                        5 => '5 Bintang',
                        4 => '4 Bintang',
                        3 => '3 Bintang',
                        2 => '2 Bintang',
                        1 => '1 Bintang',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
        ];
    }
}
