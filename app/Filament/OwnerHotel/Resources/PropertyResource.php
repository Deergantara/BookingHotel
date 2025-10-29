<?php

namespace App\Filament\OwnerHotel\Resources;

use App\Filament\OwnerHotel\Resources\PropertyResource\Pages;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Properties';

    protected static ?string $navigationGroup = 'Hotel Management';

    protected static ?int $navigationSort = 2;

    // ✅ Hanya Admin Hotel & Owner Hotel yang bisa akses
    public static function canAccess(): bool
    {
        return in_array(auth()->user()?->role, ['admin hotel', 'owner hotel']);
    }

    // ✅ Filter: Hanya tampilkan properties dari hotel admin yang login
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        // Jika admin hotel/owner hotel, filter by hotel_id
        if (in_array($user->role, ['admin hotel', 'owner hotel']) && $user->hotel_id) {
            $query->where('hotel_id', $user->hotel_id);
        }

        return $query->with(['hotel', 'tipeKamars']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Umum')
                    ->schema([
                        Forms\Components\Hidden::make('hotel_id')
                            ->default(fn () => auth()->user()->hotel_id),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Property')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('city')
                            ->label('Kota')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('area')
                            ->label('Area/Kecamatan')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('contact')
                            ->label('Kontak')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('bintang')
                            ->label('Rating Bintang')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->step(0.1)
                            ->suffix('⭐'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Kapasitas & Ketersediaan')
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_kamar')
                            ->label('Jumlah Kamar')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1),

                        Forms\Components\TextInput::make('kapasitas_tamu')
                            ->label('Kapasitas Tamu')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1),

                        Forms\Components\DatePicker::make('available_from')
                            ->label('Tersedia Dari')
                            ->native(false),

                        Forms\Components\DatePicker::make('available_to')
                            ->label('Tersedia Sampai')
                            ->native(false)
                            ->after('available_from'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Fasilitas & Media')
                    ->schema([
                        Forms\Components\Textarea::make('fasilitas')
                            ->label('Fasilitas')
                            ->rows(3)
                            ->placeholder('Contoh: WiFi, Pool, Gym, Restaurant, Spa')
                            ->helperText('Pisahkan dengan koma (,)')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Property')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->directory('properties')
                            ->imageEditor()
                            ->helperText('Upload maksimal 5 foto')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->inline(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText()
                    ->defaultImageUrl(url('/images/default-hotel.jpg')),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Property')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (Property $record): string => $record->address ?? '-'),

                Tables\Columns\TextColumn::make('city')
                    ->label('Lokasi')
                    ->formatStateUsing(fn (Property $record) => $record->city . ($record->area ? ', ' . $record->area : ''))
                    ->searchable(['city', 'area'])
                    ->sortable()
                    ->icon('heroicon-m-map-pin')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('contact')
                    ->label('Kontak')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->iconColor('success')
                    ->copyable()
                    ->copyMessage('Kontak berhasil disalin!')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('jumlah_kamar')
                    ->label('Kamar')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('kapasitas_tamu')
                    ->label('Kapasitas')
                    ->suffix(' tamu')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('bintang')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 1) . ' ⭐' : '-')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->alignCenter()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('city')
                    ->label('Kota')
                    ->options(fn () => Property::query()
                        ->where('hotel_id', auth()->user()->hotel_id)
                        ->distinct()
                        ->pluck('city', 'city')),

                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]),

                Tables\Filters\Filter::make('bintang')
                    ->label('Rating Minimum')
                    ->form([
                        Forms\Components\Select::make('bintang')
                            ->label('Minimal Bintang')
                            ->options([
                                5 => '5 Bintang',
                                4 => '4 Bintang',
                                3 => '3 Bintang',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['bintang'],
                            fn (Builder $query, $rating): Builder => $query->where('bintang', '>=', $rating),
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->emptyStateHeading('Belum ada property')
            ->emptyStateDescription('Mulai tambahkan property hotel Anda')
            ->emptyStateIcon('heroicon-o-building-office')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Property')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->persistColumnSearchesInSession();
    }

    public static function getRelations(): array
    {
        return [
            // Bisa ditambahkan RelationManager untuk TipeKamar, Bookings, dll
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'view' => Pages\ViewProperty::route('/{record}'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
