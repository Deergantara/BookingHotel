<?php

namespace App\Filament\OwnerHotel\Resources;

use App\Filament\OwnerHotel\Resources\PropertyStaffResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyStaffResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Property Staff';

    protected static ?string $modelLabel = 'Property Staff';

    protected static ?string $pluralModelLabel = 'Property Staff';

    protected static ?string $navigationGroup = 'Hotel Management';

    protected static ?int $navigationSort = 3;

    // ✅ Hanya Admin Hotel & Owner Hotel yang bisa akses
    public static function canAccess(): bool
    {
        return in_array(auth()->user()?->role, ['admin hotel', 'owner hotel']);
    }

    // ✅ Filter: Hanya tampilkan staff dari properties milik hotel admin yang login
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        // Filter hanya role: admin property & resepsionis
        $query->whereIn('role', ['admin property', 'resepsionis']);

        // Filter hanya staff dari properties yang dimiliki hotel admin yang login
        if (in_array($user->role, ['admin hotel', 'owner hotel']) && $user->hotel_id) {
            // Ambil property_ids dari hotel ini
            $propertyIds = \App\Models\Property::where('hotel_id', $user->hotel_id)->pluck('id');

            $query->whereIn('property_id', $propertyIds);
        }

        return $query->with(['property']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Staff')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('No. Telepon')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn ($context) => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->maxLength(255)
                            ->helperText('Kosongkan jika tidak ingin mengubah password'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Role & Assignment')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->label('Role')
                            ->options([
                                'admin property' => 'Admin Property',
                                'resepsionis' => 'Resepsionis',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\Select::make('property_id')
                            ->label('Property')
                            ->options(function () {
                                $user = auth()->user();
                                if ($user->hotel_id) {
                                    return \App\Models\Property::where('hotel_id', $user->hotel_id)
                                        ->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Pilih property yang akan dikelola staff ini'),

                        Forms\Components\TextInput::make('nomor_identitas')
                            ->label('Nomor Identitas (KTP/SIM)')
                            ->numeric()
                            ->maxLength(20),

                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->native(false)
                            ->maxDate(now()->subYears(17)),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn (User $record): string => $record->email)
                    ->icon('heroicon-m-user')
                    ->iconColor('primary'),

                Tables\Columns\TextColumn::make('property.name')
                    ->label('Property')
                    ->searchable()
                    ->sortable()
                    ->description(fn (User $record) => $record->property?->city ? $record->property->city . ', ' . $record->property->area : '-')
                    ->icon('heroicon-m-building-office')
                    ->iconColor('success')
                    ->wrap(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin property' => 'info',
                        'resepsionis' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin property' => 'Admin Property',
                        'resepsionis' => 'Resepsionis',
                        default => $state,
                    })
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->iconColor('success')
                    ->copyable()
                    ->copyMessage('Nomor telepon berhasil disalin!')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Registrasi')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->description(fn (User $record): string => $record->created_at->diffForHumans())
                    ->icon('heroicon-m-calendar')
                    ->iconColor('gray'),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diupdate')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filter Role')
                    ->options([
                        'admin property' => 'Admin Property',
                        'resepsionis' => 'Resepsionis',
                    ])
                    ->native(false),

                Tables\Filters\SelectFilter::make('property_id')
                    ->label('Filter Property')
                    ->relationship('property', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->native(false),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Registrasi Dari')
                            ->native(false),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Registrasi Sampai')
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
            ->emptyStateHeading('Belum ada staff property')
            ->emptyStateDescription('Tambahkan admin property atau resepsionis untuk mengelola property Anda')
            ->emptyStateIcon('heroicon-o-user-group')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Staff')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistFiltersInSession()
            ->persistSearchInSession();
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
            'index' => Pages\ListPropertyStaff::route('/'),
            'create' => Pages\CreatePropertyStaff::route('/create'),
            'view' => Pages\ViewPropertyStaff::route('/{record}'),
            'edit' => Pages\EditPropertyStaff::route('/{record}/edit'),
        ];
    }
}
