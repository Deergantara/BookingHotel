<x-filament-widgets::widget>
    @php
        $property = $this->getPropertyData();
    @endphp

    @if($property)
    <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="flex items-start gap-6">
            {{-- Logo/Foto --}}
            <div class="flex-shrink-0">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                    {{ strtoupper(substr($property->name, 0, 2)) }}
                </div>
            </div>

            {{-- Info --}}
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $property->name }}
                </h2>

                <div class="mt-2 flex items-center gap-2 text-gray-600 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $property->address }}</span>
                </div>

                <div class="mt-3 flex items-center gap-6">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span class="font-medium">{{ $property->contact }}</span>
                    </div>

                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($property->bintang))
                                <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ number_format($property->bintang, 1) }} / 5.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
        <p class="text-red-600 dark:text-red-400">Property tidak ditemukan. Hubungi administrator.</p>
    </div>
    @endif
</x-filament-widgets::widget>
