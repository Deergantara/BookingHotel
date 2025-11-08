<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Edit Profile';

    protected static ?string $navigationGroup = 'Account';

    protected static ?string $slug = 'profile';

    // Sembunyikan dari navigation
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('nomor_identitas')
                            ->numeric()
                            ->maxLength(16)
                            ->label('Nomor Identitas'),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir'),
                        Forms\Components\Placeholder::make('role')
                            ->label('Role')
                            ->content(fn ($record) => $record->formatted_role ?? ''),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Change Password')
                    ->description('Kosongkan jika tidak ingin mengubah password')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->label('Password Baru')
                            ->dehydrated(fn ($state) => filled($state))
                            ->rule(Password::default())
                            ->autocomplete('new-password')
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->same('passwordConfirmation'),
                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->password()
                            ->label('Konfirmasi Password Baru')
                            ->required(fn ($get) => filled($get('password')))
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'), // <- ini wajib ada
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = Auth::user();
        return $user && $user->role !== 'user';
    }
}
