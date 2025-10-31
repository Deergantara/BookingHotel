<?php

namespace App\Filament\AdminProperty\Resources;

use App\Filament\AdminProperty\Resources\RoomTypeResource\Pages;
use App\Models\TipeKamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RoomTypeResource extends Resource
{
    protected static ?string $model = TipeKamar::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationLabel = 'Room Types';

    protected static ?string $navigationGroup = 'Main';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin property';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('property_id', auth()->user()->property_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Tipe Kamar')
                    ->schema([
                        Forms\Components\Hidden::make('property_id')
                            ->default(auth()->user()->property_id),

                        Forms\Components\TextInput::make('nama_tipe')
                            ->label('Nama Tipe Kamar')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('kapasitas')
                            ->label('Maksimum Tamu (Adults)')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\TextInput::make('harga')
                            ->label('Harga per Malam')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        Forms\Components\TextInput::make('stok_kamar')
                            ->label('Total Kamar')
                            ->required()
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\Textarea::make('fasilitas_kamar')
                            ->label('Fasilitas Kamar')
                            ->rows(2)
                            ->placeholder('AC, TV, WiFi, dll')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Kamar')
                            ->image()
                            ->directory('room-types')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('nama_tipe')
                    ->label('Tipe Kamar')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga/Malam')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kapasitas')
                    ->label('Max Adults')
                    ->suffix(' orang')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('stok_kamar')
                    ->label('Total Kamar')
                    ->badge()
                    ->color('info')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('available_count')
                    ->label('Available')
                    ->getStateUsing(fn ($record) => $record->kamars()->where('status', 'tersedia')->count())
                    ->badge()
                    ->color('success')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoomTypes::route('/'),
            'create' => Pages\CreateRoomType::route('/create'),
            'edit' => Pages\EditRoomType::route('/{record}/edit'),
        ];
    }
}
