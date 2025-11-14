<?php

namespace App\Filament\Resepsionis\Resources;

use App\Filament\Resepsionis\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Booking';

    // FILTER: Hanya tampilkan Booking di property resepsionis
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('property_id', auth()->user()->property_id)
            ->with(['user', 'kamar', 'payment']);
    }

    public static function form(Form $form): Form
    {
    return $form
    ->schema([
    Forms\Components\Section::make('Informasi Tamu')
    ->schema([
    Forms\Components\Select::make('user_id')
    ->relationship('user', 'name')
    ->searchable()
    ->required()
    ->createOptionForm([
        Forms\Components\TextInput::make('name')->required(),
        Forms\Components\TextInput::make('email')->email()->required(),
        Forms\Components\TextInput::make('phone'),
        Forms\Components\Hidden::make('password')
            ->default(bcrypt('password123')), // ← default password
    ]),

                    ]),

                Forms\Components\Section::make('Detail Booking')
                    ->schema([
                        Forms\Components\Select::make('kamar_id')
                            ->relationship(
                            'kamar',
                            'nomor_kamar',
                            fn (Builder $query) => $query
                            ->whereHas('tipeKamar', fn ($q) =>
                            $q->where('property_id', auth()->user()->property_id))
                            ->where('status', 'tersedia'))->required()->searchable()->preload(),

                        Forms\Components\DatePicker::make('checkin_date')
                            ->required()->native(false)->minDate(now()),

                        Forms\Components\DatePicker::make('checkout_date')
                            ->required()->native(false)->after('checkin_date'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'checked_in' => 'Checked In',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->default('confirmed')
                            ->required(),

                        Forms\Components\Hidden::make('property_id')
                            ->default(auth()->user()->property_id),

                        Forms\Components\Hidden::make('created_by')
                            ->default(auth()->id()),

                        Forms\Components\Hidden::make('is_offline')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Tamu')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kamar.nomor_kamar')
                    ->label('No. Kamar')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('checkin_date')
                    ->label('Check-in')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('checkout_date')
                    ->label('Check-out')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'info',
                        'checked_in' => 'success',
                        'completed' => 'gray',
                        'cancelled' => 'danger',
                    }),

                Tables\Columns\IconColumn::make('is_offline')
                    ->label('Offline')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('payment.transaction_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'settlement' => 'success',
                        'pending' => 'warning',
                        default => 'danger',
                    })
                    ->default('Belum dibayar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'checked_in' => 'Checked In',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),

                Tables\Filters\Filter::make('checkin_today')
                    ->label('Check-in Hari Ini')
                    ->query(fn (Builder $query) => $query->whereDate('checkin_date', today())),

                Tables\Filters\Filter::make('checkout_today')
                    ->label('Check-out Hari Ini')
                    ->query(fn (Builder $query) => $query->whereDate('checkout_date', today())),
            ])
            ->actions([
                // ACTION: CHECK-IN
                Tables\Actions\Action::make('checkin')
                    ->label('Check-in')
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->color('success')
                    ->visible(fn (Booking $record) => $record->status === 'confirmed')
                    ->requiresConfirmation()
                    ->action(function (Booking $record) {
                        $record->update(['status' => 'checked_in']);
                        $record->kamar->update(['status' => 'ditempati']);

                        Notification::make()
                            ->title('Check-in berhasil!')
                            ->success()
                            ->send();
                    }),

                // ACTION: CHECK-OUT
                Tables\Actions\Action::make('checkout')
                    ->label('Check-out')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->color('warning')
                    ->visible(fn (Booking $record) => $record->status === 'checked_in')
                    ->requiresConfirmation()
                    ->action(function (Booking $record) {
                        $record->update(['status' => 'completed']);
                        $record->kamar->update(['status' => 'tersedia']);

                        Notification::make()
                            ->title('Check-out berhasil!')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
