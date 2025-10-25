<x-filament-widgets::widget>
    @php
        $data = $this->getSummaryData();
    @endphp

    <x-filament::section>
        <x-slot name="heading">
            Summary Tahunan 2025
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Total Revenue --}}
            <div class="p-6 bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600 dark:text-green-400">Total Revenue</p>
                        <p class="text-2xl font-bold text-green-900 dark:text-green-100 mt-1">
                            Rp {{ number_format($data['totalRevenue'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-green-200 dark:bg-green-700 rounded-lg">
                        <svg class="w-8 h-8 text-green-700 dark:text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Tax Collected --}}
            <div class="p-6 bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900 dark:to-red-800 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">Tax Collected</p>
                        <p class="text-2xl font-bold text-red-900 dark:text-red-100 mt-1">
                            Rp {{ number_format($data['taxCollected'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-red-200 dark:bg-red-700 rounded-lg">
                        <svg class="w-8 h-8 text-red-700 dark:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Net Revenue --}}
            <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 rounded-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Net Revenue</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-100 mt-1">
                            Rp {{ number_format($data['netRevenue'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-3 bg-blue-200 dark:bg-blue-700 rounded-lg">
                        <svg class="w-8 h-8 text-blue-700 dark:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>