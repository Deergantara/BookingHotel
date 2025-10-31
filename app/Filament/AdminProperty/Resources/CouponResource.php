<?php

namespace App\Filament\AdminProperty\Resources;

use App\Filament\AdminProperty\Resources\CouponResource\Pages;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Coupons';

    protected static ?string $navigationGroup = 'Booking Management';

    protected static ?int $navigationSort = 2;

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
                Forms\Components\Section::make('Informasi Kupon')
                    ->schema([
                        Forms\Components\Hidden::make('property_id')
                            ->default(auth()->user()->property_id),

                        Forms\Components\TextInput::make('code')
                            ->label('Kode Kupon')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('DISKON50')
                            ->helperText('Kode harus unik'),

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Kupon')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Diskon Tahun Baru'),

                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'online' => 'Online',
                                'offline' => 'Offline',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('scope')
                            ->label('Scope')
                            ->options([
                                'all_hotels' => 'Semua Hotel',
                                'specific_property' => 'Property Ini Saja',
                            ])
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Diskon & Pembatasan')
                    ->schema([
                        Forms\Components\Select::make('discount_type')
                            ->label('Tipe Diskon')
                            ->options([
                                'fixed' => 'Fixed Amount (Rp)',
                                'percentage' => 'Percentage (%)',
                            ])
                            ->required()
                            ->live()
                            ->native(false),

                        Forms\Components\TextInput::make('discount_value')
                            ->label('Nilai Diskon')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->suffix(fn ($get) => $get('discount_type') === 'percentage' ? '%' : 'Rp'),

                        Forms\Components\TextInput::make('min_payment')
                            ->label('Minimal Pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Kosongkan jika tidak ada minimal'),

                        Forms\Components\TextInput::make('max_payment')
                            ->label('Maksimal Pembayaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Kosongkan jika tidak ada maksimal'),

                        Forms\Components\TextInput::make('quota')
                            ->label('Kuota Kupon')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->helperText('Berapa kali kupon bisa digunakan'),

                        Forms\Components\TextInput::make('used')
                            ->label('Sudah Digunakan')
                            ->numeric()
                            ->disabled()
                            ->default(0),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Periode Aktif')
                    ->schema([
                        Forms\Components\DatePicker::make('valid_from')
                            ->label('Berlaku Dari')
                            ->native(false)
                            ->required(),

                        Forms\Components\DatePicker::make('valid_until')
                            ->label('Berlaku Sampai')
                            ->native(false)
                            ->after('valid_from')
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->badge()
                    ->color('primary')
                    ->copyable()
                    ->copyMessage('Kode kupon berhasil disalin!'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Kupon')
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'online' => 'info',
                        'offline' => 'warning',
                    }),

                Tables\Columns\TextColumn::make('discount')
                    ->label('Diskon')
                    ->getStateUsing(fn ($record) =>
                        $record->discount_type === 'percentage'
                            ? $record->discount_value . '%'
                            : 'Rp ' . number_format($record->discount_value, 0, ',', '.')
                    )
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('quota_usage')
                    ->label('Kuota')
                    ->getStateUsing(fn ($record) => $record->used . '/' . $record->quota)
                    ->badge()
                    ->color(fn ($record) => $record->used >= $record->quota ? 'danger' : 'info'),

                Tables\Columns\TextColumn::make('valid_until')
                    ->label('Berlaku Sampai')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
