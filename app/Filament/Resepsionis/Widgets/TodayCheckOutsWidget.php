<?php

namespace App\Filament\Resepsionis\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Notifications\Notification;

class TodayCheckOutsWidget extends BaseWidget
{
    protected static ?string $heading = "Daftar Tamu Check-out Hari Ini";

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $propertyId = auth()->user()->property_id;

        return $table
            ->query(
                Booking::query()
                    ->where('property_id', $propertyId)
                    ->whereDate('checkout_date', today())
                    ->where('status', 'checked_in')
                    ->with(['user', 'kamar'])
                    ->orderBy('checkout_date', 'asc')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Tamu')
                    ->searchable()
                    ->weight('bold')
                    ->icon('heroicon-m-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('kamar.nomor_kamar')
                    ->label('Nomor Kamar')
                    ->badge()
                    ->color('warning')
                    ->default('-'),

                Tables\Columns\TextColumn::make('kamar.tipeKamar.nama_tipe')
                    ->label('Tipe Kamar')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('checkin_date')
                    ->label('Check-in')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('checkout_date')
                    ->label('Waktu Check-out')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->icon('heroicon-m-clock')
                    ->iconColor('warning'),

                Tables\Columns\TextColumn::make('lama_menginap')
                    ->label('Lama Menginap')
                    ->getStateUsing(fn (Booking $record) =>
                        $record->checkin_date && $record->checkout_date
                            ? $record->checkin_date->diffInDays($record->checkout_date) . ' hari'
                            : '-'
                    )
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Telepon')
                    ->searchable()
                    ->toggleable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color('warning'),
            ])
            ->actions([
                Tables\Actions\Action::make('checkout')
                    ->label('Check-out')
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Konfirmasi Check-out')
                    ->modalDescription(fn (Booking $record) =>
                        'Check-out tamu ' . $record->user->name . ' dari kamar ' . ($record->kamar->nomor_kamar ?? '-') . '?'
                    )
                    ->action(function (Booking $record) {
                        $record->update(['status' => 'completed']);

                        if ($record->kamar) {
                            $record->kamar->update(['status' => 'tersedia']);
                        }

                        Notification::make()
                            ->title('Check-out berhasil!')
                            ->success()
                            ->body('Tamu ' . $record->user->name . ' telah check-out.')
                            ->send();
                    }),

                Tables\Actions\ViewAction::make()
                    ->label('Detail'),
            ])
            ->emptyStateHeading('Tidak ada check-out hari ini')
            ->emptyStateDescription('Belum ada tamu yang dijadwalkan check-out hari ini')
            ->emptyStateIcon('heroicon-o-calendar')
            ->paginated(false);
    }
}
