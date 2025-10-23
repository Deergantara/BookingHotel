<?php

namespace App\Filament\Resepsionis\Resources;

use App\Filament\Resepsionis\Resources\KamarResource\Pages;
use App\Models\Kamar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KamarResource extends Resource
{
    protected static ?string $model = Kamar::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Kamar';

    // FILTER: Hanya kamar di property resepsionis
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('tipeKamar', fn ($query) => 
                $query->where('property_id', auth()->user()->property_id)
            )
            ->with('tipeKamar');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_kamar')
                    ->label('Nomor Kamar')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'dipesan' => 'Dipesan',
                        'ditempati' => 'Ditempati',
                        'perbaikan' => 'Perbaikan',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('catatan')
                    ->label('Catatan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_kamar')
                    ->label('No. Kamar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tipeKamar.nama_tipe')
                    ->label('Tipe Kamar')
                    ->searchable(),

                Tables\Columns\TextColumn::make('lantai')
                    ->label('Lantai'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'tersedia' => 'success',
                        'dipesan' => 'info',
                        'ditempati' => 'warning',
                        'perbaikan' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('catatan')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->catatan),
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
                // Quick action untuk update status
                Tables\Actions\Action::make('set_perbaikan')
                    ->label('Perbaikan')
                    ->icon('heroicon-o-wrench')
                    ->color('danger')
                    ->action(fn (Kamar $record) => $record->update(['status' => 'perbaikan'])),

                Tables\Actions\Action::make('set_tersedia')
                    ->label('Tersedia')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn (Kamar $record) => $record->update(['status' => 'tersedia'])),

                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('nomor_kamar', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKamars::route('/'),
            'edit' => Pages\EditKamar::route('/{record}/edit'),
        ];
    }
}