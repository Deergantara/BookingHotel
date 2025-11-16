<x-filament-panels::page>
    {{-- Stats Cards Row 1 (2 kolom) --}}
    <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-6">
        @livewire(\App\Filament\Owner\Widgets\TotalRevenueWidget::class)
        @livewire(\App\Filament\Owner\Widgets\TotalHotelWidget::class)
        @livewire(\App\Filament\Owner\Widgets\TotalPropertyWidget::class)
    </div>

    {{-- Stats Cards Row 2 (3 kolom) --}}
    <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2 lg:grid-cols-3 mb-6">
        @livewire(\App\Filament\Owner\Widgets\TotalBookingWidget::class)
        @livewire(\App\Filament\Owner\Widgets\TotalUsersWidget::class)
        @livewire(\App\Filament\Owner\Widgets\OccupancyRateWidget::class)
    </div>

    {{-- Charts Section --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-4">Analitik & Statistik</h2>

        {{-- Chart Row 1 --}}
        <div class="grid grid-cols-1 gap-4 lg:gap-6 xl:grid-cols-2 mb-6">
            @livewire(\App\Filament\Owner\Widgets\RevenueChartWidget::class)
            @livewire(\App\Filament\Owner\Widgets\TopHotelsChartWidget::class)
        </div>

        {{-- Chart Row 2 --}}
        <div class="grid grid-cols-1 gap-4 lg:gap-6 xl:grid-cols-2 mb-6">
            @livewire(\App\Filament\Owner\Widgets\MonthlyBookingTrendWidget::class)
            @livewire(\App\Filament\Owner\Widgets\PaymentStatusChartWidget::class)
        </div>
    </div>

    {{-- Amount Summary Section --}}
    <div>
        <h2 class="text-lg font-semibold mb-4">Ringkasan Keuangan</h2>
        <div class="grid grid-cols-1 gap-4 lg:gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @livewire(\App\Filament\Owner\Widgets\GrossAmountWidget::class)
            @livewire(\App\Filament\Owner\Widgets\TotalDiscountWidget::class)
            @livewire(\App\Filament\Owner\Widgets\NetAmountWidget::class)
        </div>
    </div>
</x-filament-panels::page>
