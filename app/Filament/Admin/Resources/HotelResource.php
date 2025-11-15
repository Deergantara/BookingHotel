<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelResource\Pages;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Illuminate\Database\Eloquent\Builder;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Hotel';

    protected static ?string $modelLabel = 'Hotel';

    protected static ?string $pluralModelLabel = 'Hotels';

    protected static ?string $navigationGroup = 'Manajemen Hotel';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Hotel')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Hotel')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Hotel Santika Sukabumi')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('tdup')
                            ->label('TDUP (Tanda Daftar Usaha Pariwisata)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: 123/TDUP/2024')
                            ->helperText('Nomor Tanda Daftar Usaha Pariwisata'),

                        Forms\Components\TextInput::make('npwp')
                            ->label('NPWP')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: 12.345.678.9-012.000')
                            ->mask('99.999.999.9-999.999')
                            ->helperText('Format: XX.XXX.XXX.X-XXX.XXX'),

                        // ✅ PERBAIKI: Sesuaikan dengan ENUM di database
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'verified' => 'Verified',
                    'rejected' => 'Rejected',
                ])
                ->default('pending') // Sesuai dengan default di migration
                ->required()
                            ->native(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Hotel')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-m-building-office-2'),

                Tables\Columns\TextColumn::make('tdup')
                    ->label('TDUP')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('TDUP berhasil disalin!')
                    ->tooltip('Klik untuk copy'),

                Tables\Columns\TextColumn::make('npwp')
                    ->label('NPWP')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('NPWP berhasil disalin!')
                    ->tooltip('Klik untuk copy'),

                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'verified' => 'success',
                    'rejected' => 'danger',
                    default => 'gray',
                })
                    ->icons([
                        'heroicon-o-check-circle' => 'active',
                        'heroicon-o-x-circle' => 'inactive',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('properties_count')
                    ->label('Jumlah Property')
                    ->counts('properties')
                    ->badge()
                    ->color('info')
                    ->icon('heroicon-o-home'),

                Tables\Columns\TextColumn::make('users_count')
                    ->label('Jumlah User')
                    ->counts('users')
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-users'),

                Tables\Columns\TextColumn::make('bookings_count')
                ->label('Total Bookings')
                ->counts('bookings'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                    'verified' => 'Verified',
                    'rejected' => 'Rejected',
                    ])
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Hotel')
                    ->schema([
                        TextEntry::make('nama')
                            ->label('Nama Hotel')
                            ->size('lg')
                            ->weight('bold')
                            ->icon('heroicon-o-building-office-2'),

                        TextEntry::make('tdup')
                            ->label('TDUP')
                            ->copyable()
                            ->icon('heroicon-o-document-text'),

                        TextEntry::make('npwp')
                            ->label('NPWP')
                            ->copyable()
                            ->icon('heroicon-o-identification'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'verified' => 'success',
                                'rejected' => 'danger',
                                default => 'gray',
                            }),
                    ])
                    ->columns(2),

                Section::make('Statistik')
                    ->schema([
                        TextEntry::make('properties_count')
                            ->label('Total Property')
                            ->state(fn ($record) => $record->properties()->count())
                            ->icon('heroicon-o-home')
                            ->badge()
                            ->color('info'),

                        TextEntry::make('users_count')
                            ->label('Total User/Owner')
                            ->state(fn ($record) => $record->users()->count())
                            ->icon('heroicon-o-users')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('bookings_count')
                            ->label('Total Booking')
                            ->state(fn ($record) => $record->Bookings()->count())
                            ->icon('heroicon-o-calendar')
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(3),

                Section::make('Informasi Sistem')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d F Y, H:i')
                            ->icon('heroicon-o-clock'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diupdate')
                            ->dateTime('d F Y, H:i')
                            ->icon('heroicon-o-arrow-path'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'view' => Pages\ViewHotel::route('/{record}'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
