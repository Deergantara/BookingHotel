<?php

namespace App\Filament\AdminProperty\Resources;

use App\Filament\AdminProperty\Resources\RoomResource\Pages;
use App\Models\Kamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RoomResource extends Resource
{
    protected static ?string $model = Kamar::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Rooms';

    protected static ?string $navigationGroup = 'Main';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin property';
    }

    public static function getEloquentQuery(): Builder
    {
        $propertyId = auth()->user()->property_id;

        return parent::getEloquentQuery()
            ->whereHas('tipeKamar', function($query) use ($propertyId) {
                $query->where('property_id', $propertyId);
            });
    }

    public static function form(Form $form): Form
    {
        $propertyId = auth()->user()->property_id;

        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kamar')
                    ->schema([
                        Forms\Components\Select::make('tipe_kamar_id')
                            ->label('Tipe Kamar')
                            ->relationship('tipeKamar', 'nama_tipe', fn ($query) =>
                                $query->where('property_id', $propertyId)
                            )
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('nomor_kamar')
                            ->label('Nomor Kamar')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20),

                        Forms\Components\TextInput::make('lantai')
                            ->label('Lantai')
                            ->maxLength(10),

                        Forms\Components\TextInput::make('posisi')
                            ->label('Posisi')
                            ->maxLength(50),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'tersedia' => 'Tersedia',
                                'dipesan' => 'Dipesan',
                                'ditempati' => 'Ditempati',
                                'perbaikan' => 'Perbaikan',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\Textarea::make('catatan')
                            ->label('Notes (untuk maintenance)')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_kamar')
                    ->label('No. Kamar')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('tipeKamar.nama_tipe')
                    ->label('Tipe Kamar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipeKamar.harga')
                    ->label('Harga/Malam')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('lantai')
                    ->label('Lantai')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tersedia' => 'success',
                        'dipesan' => 'info',
                        'ditempati' => 'warning',
                        'perbaikan' => 'danger',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Notes')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'dipesan' => 'Dipesan',
                        'ditempati' => 'Ditempati',
                        'perbaikan' => 'Perbaikan',
                    ]),

                Tables\Filters\SelectFilter::make('tipe_kamar_id')
                    ->label('Tipe Kamar')
                    ->relationship('tipeKamar', 'nama_tipe'),
            ])
            ->actions([
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
