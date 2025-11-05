<?php

namespace App\Filament\AdminProperty\Widgets;

use App\Models\Property;
use Filament\Widgets\Widget;

class PropertyInfoWidget extends Widget
{
    protected static string $view = 'filament.admin-property.widgets.property-info-widget';

    protected int | string | array $columnSpan = 'full';

    public function getPropertyData(): ?Property
    {
        return Property::find(auth()->user()->property_id);
    }
}
