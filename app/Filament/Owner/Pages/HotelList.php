<?php

namespace App\Filament\Owner\Pages;

use App\Models\Hotel;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;

class HotelList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static string $view = 'filament.owner.pages.hotel-list';

    protected static ?string $navigationLabel = 'Daftar Hotel';

    protected static ?string $title = 'Daftar Hotel Kerjasama';

    public function table(Table $table): Table
    {
        return $table
            ->query(Hotel::query()->whereIn('status', ['verified', 'active']))
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Hotel')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('npwp')
                    ->label('NPWP')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tdup')
                    ->label('TDUP')
                    ->searchable()
                    ->default('-'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'verified',
                        'success' => 'active',
                    ]),

                Tables\Columns\TextColumn::make('properties_count')
                    ->label('Jumlah Property')
                    ->counts('properties')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bergabung Sejak')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'verified' => 'Verified',
                        'active' => 'Active',
                    ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
