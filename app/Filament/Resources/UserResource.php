<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\UserResource\Pages;
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

    // Hanya admin system yang bisa akses
    public static function canAccess(): bool
    {
        return auth()->user()?->isAdminSystem() ?? false;
    }

    // Badge count di navigation
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $schema): Form
    {
        return $schema
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->description('Basic user information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Full Name')->required()->maxLength(255)->prefixIcon('heroicon-o-user')
                            ->placeholder('John Doe'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')->email()->required()->unique(ignoreRecord: true)
                            ->maxLength(255)->prefixIcon('heroicon-o-envelope')->placeholder('john@example.com'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')->tel()->maxLength(20)
                            ->prefixIcon('heroicon-o-phone')->placeholder('+62 812 3456 7890'),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)->prefixIcon('heroicon-o-lock-closed')->placeholder('••••••••')
                            ->helperText('Leave blank to keep current password (only for edit)'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Role & Access')
                    ->description('User role and permissions')
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
                                // Reset hotel & property jika role tidak memerlukan
                                if (in_array($state, ['user', 'admin system', 'owner system'])) {
                                    $set('hotel_id', null);
                                    $set('property_id', null);
                                }
                            }),

                        Forms\Components\Select::make('otel_idotel_id')
                            ->label('Hotel')
                            ->relationship('hotel', 'nama')
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-o-building-office')
                            ->visible(fn (Get $get) => in_array($get('role'), ['admin hotel', 'owner hotel', 'admin property', 'resepsionis']))
                            ->required(fn (Get $get) => in_array($get('role'), ['admin hotel', 'owner hotel']))
                            ->live()
                            ->afterStateUpdated(fn (Forms\Set $set) => $set('property_id', null)),

                        Forms\Components\Select::make('property_id')
                            ->label('Property')
                            ->options(function (Get $get) {
                                $hotelId = $get('hotel_id');
                                if (!$hotelId) {
                                    return [];
                                }
                                return Property::where('hotel_id', $hotelId)
                                    ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->prefixIcon('heroicon-o-building-storefront')
                            ->visible(fn (Get $get) => in_array($get('role'), ['admin property', 'resepsionis']))
                            ->required(fn (Get $get) => in_array($get('role'), ['admin property', 'resepsionis']))
                            ->disabled(fn (Get $get) => !$get('hotel_id'))
                            ->helperText('Please select hotel first'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Additional Information')
                    ->description('Optional customer data')
                    ->schema([
                        Forms\Components\TextInput::make('nomor_identitas')
                            ->label('ID Number (KTP/Passport)')
                            ->numeric()
                            ->maxLength(20)
                            ->prefixIcon('heroicon-o-identification')
                            ->placeholder('3201234567890123'),

                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Birth Date')
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->prefixIcon('heroicon-o-cake')
                            ->maxDate(now()),
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
                    ->label('ID')->sortable()
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')->icon('heroicon-o-user')->searchable()
                    ->sortable()->wrap(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')->icon('heroicon-o-envelope')->searchable()
                    ->sortable()->copyable()->copyMessage('Email copied!')->wrap(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')->icon('heroicon-o-phone')->searchable()
                    ->toggleable()->placeholder('—'),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->colors([
                        'success' => 'user',
                        'danger' => ['admin system', 'owner system'],
                        'warning' => ['admin hotel', 'owner hotel'],
                        'info' => ['admin property', 'resepsionis'],
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'admin system' => 'Admin System',
                        'owner system' => 'Owner System',
                        'admin hotel' => 'Admin Hotel',
                        'owner hotel' => 'Owner Hotel',
                        'admin property' => 'Admin Property',
                        'resepsionis' => 'Resepsionis',
                        'user' => 'Customer',
                        default => ucfirst($state)
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('hotel.nama')
                    ->label('Hotel')
                    ->icon('heroicon-o-building-office')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->placeholder('—')
                    ->wrap(),

                Tables\Columns\TextColumn::make('property.name')
                    ->label('Property')
                    ->icon('heroicon-o-building-storefront')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->placeholder('—')
                    ->wrap(),

                Tables\Columns\TextColumn::make('nomor_identitas')
                    ->label('ID Number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Birth Date')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->options([
                        'user' => 'Customer',
                        'admin system' => 'Admin System',
                        'owner system' => 'Owner System',
                        'admin hotel' => 'Admin Hotel',
                        'owner hotel' => 'Owner Hotel',
                        'admin property' => 'Admin Property',
                        'resepsionis' => 'Resepsionis',
                    ])
                    ->multiple()
                    ->preload(),

                Tables\Filters\SelectFilter::make('hotel_id')
                    ->label('Filter by Hotel')
                    ->relationship('hotel', 'nama')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                Tables\Filters\SelectFilter::make('property_id')
                    ->label('Filter by Property')
                    ->relationship('property', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Registered From')
                            ->native(false),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Registered Until')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
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
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No users yet')
            ->emptyStateDescription('Create your first user to get started.')
            ->emptyStateIcon('heroicon-o-users');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
