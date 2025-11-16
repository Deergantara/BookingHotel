<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FasilitasResource\Pages;
use App\Filament\Admin\Resources\FasilitasResource\RelationManagers;
use App\Models\Fasilitas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Fasilitas';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Fasilitas')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: WiFi, Kolam Renang, AC'),

                        Forms\Components\Select::make('kategori')
                            ->options([
                                'umum' => 'Umum',
                                'kamar' => 'Kamar',
                                'hotel' => 'Hotel',
                                'restoran' => 'Restoran',
                                'rekreasi' => 'Rekreasi',
                            ])
                            ->required()
                            ->default('umum'),

                        Forms\Components\TextInput::make('icon')
                            ->label('Icon Font Awesome')
                            ->placeholder('Contoh: wifi, swimming-pool, snowflake')
                            ->helperText('Lihat di: https://fontawesome.com/icons')
                            ->maxLength(255),

                        Forms\Components\Textarea::make('deskripsi')
                            ->rows(3)
                            ->placeholder('Deskripsi singkat fasilitas...'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'umum' => 'info',
                        'kamar' => 'primary',
                        'hotel' => 'success',
                        'restoran' => 'warning',
                        'rekreasi' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('properties_count')
                    ->label('Jumlah Property')
                    ->counts('properties')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->options([
                        'umum' => 'Umum',
                        'kamar' => 'Kamar',
                        'hotel' => 'Hotel',
                        'restoran' => 'Restoran',
                        'rekreasi' => 'Rekreasi',
                    ]),

                Tables\Filters\Filter::make('is_active')
                    ->label('Hanya Aktif')
                    ->query(fn ($query) => $query->where('is_active', true)),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFasilitas::route('/'),
            'create' => Pages\CreateFasilitas::route('/create'),
            'edit' => Pages\EditFasilitas::route('/{record}/edit'),
        ];
    }
}
