<?php

namespace App\Filament\AdminProperty\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use App\Models\Property;

class MyProperty extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static string $view = 'filament.admin-property.pages.my-property';

    protected static ?string $navigationLabel = 'My Property';

    protected static ?string $title = 'Edit Property';

    protected static ?string $navigationGroup = 'Main';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin property';
    }

    public function mount(): void
    {
        $property = Property::find(auth()->user()->property_id);

        if (!$property) {
            Notification::make()
                ->title('Property not found')
                ->danger()
                ->send();
            return;
        }

        $this->form->fill($property->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Property')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Property')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(2)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('city')
                            ->label('Kota')
                            ->required(),

                        Forms\Components\TextInput::make('area')
                            ->label('Area/Kecamatan'),

                        Forms\Components\TextInput::make('contact')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required(),

                        Forms\Components\TextInput::make('bintang')
                            ->label('Rating Bintang')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->step(0.1)
                            ->suffix('⭐'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Fasilitas & Media')
                    ->schema([
                        Forms\Components\Textarea::make('fasilitas')
                            ->label('Fasilitas')
                            ->rows(3)
                            ->placeholder('WiFi, Pool, Gym, Restaurant, Spa')
                            ->helperText('Pisahkan dengan koma'),

                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto Property')
                            ->image()
                            ->multiple()
                            ->maxFiles(5)
                            ->directory('properties')
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $property = Property::find(auth()->user()->property_id);

        if (!$property) {
            Notification::make()
                ->title('Property not found')
                ->danger()
                ->send();
            return;
        }

        $property->update($this->form->getState());

        Notification::make()
            ->title('Property updated successfully!')
            ->success()
            ->send();
    }
}
