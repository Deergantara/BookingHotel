<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\Hotel;
use App\Models\Property;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdminSystem() ?? false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-user'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->prefixIcon('heroicon-o-envelope'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20)
                            ->prefixIcon('heroicon-o-phone'),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->helperText('Leave blank when editing to keep current password'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Role & Access')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->label('Role')
                            ->options([
                                'user' => 'Customer',
                                'admin system' => 'Admin System',
                                'owner system' => 'Owner System',
                                'admin hotel' => 'Admin Hotel',
                                'owner hotel' => 'Owner Hotel',
                                'admin property' => 'Admin Property',
                                'resepsionis' => 'Resepsionis',
                            ])
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-o-shield-check')
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if (in_array($state, ['user', 'admin system', 'owner system'])) {
                                    $set('hotel_id', null);
                                    $set('property_id', null);
                                }
                            }),

                        Forms\Components\Select::make('hotel_id')
                            ->label('Hotel')
                            ->relationship('hotel', 'nama')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-o-building-office')
                            ->visible(fn (Get $get) => in_array($get('role'), [
                                'admin hotel', 'owner hotel', 'admin property', 'resepsionis'
                            ]))
                            ->required(fn (Get $get) => in_array($get('role'), [
                                'admin hotel', 'owner hotel'
                            ]))
                            ->live()
                            ->afterStateUpdated(fn (Forms\Set $set) => $set('property_id', null)),

                        Forms\Components\Select::make('property_id')
                            ->label('Property')
                            ->options(function (Get $get) {
                                $hotelId = $get('hotel_id');
                                if (!$hotelId) return [];
                                return Property::where('hotel_id', $hotelId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-o-building-storefront')
                            ->visible(fn (Get $get) => in_array($get('role'), [
                                'admin property', 'resepsionis'
                            ]))
                            ->required(fn (Get $get) => in_array($get('role'), [
                                'admin property', 'resepsionis'
                            ]))
                            ->disabled(fn (Get $get) => !$get('hotel_id'))
                            ->helperText('Select hotel first'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_identitas')
                            ->label('ID Number')
                            ->maxLength(20)
                            ->numeric()
                            ->prefixIcon('heroicon-o-identification'),

                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Birth Date')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->maxDate(now())
                            ->prefixIcon('heroicon-o-cake'),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hotel.nama')
                    ->label('Hotel')
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('property.name')
                    ->label('Property')
                    ->sortable()
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
