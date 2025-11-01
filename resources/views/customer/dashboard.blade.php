@extends('layouts.app')

@section('title', 'Dashboard - Luxury Allure')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-2xl shadow-lg p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-white/90">
                        Kelola booking Anda dan temukan penawaran terbaik
                    </p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-crown text-white text-6xl opacity-20"></i>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Stat 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Total Booking</p>
                        <h3 class="text-3xl font-bold text-gray-900">0</h3>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-lg">
                        <i class="fas fa-calendar-check text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Booking Aktif</p>
                        <h3 class="text-3xl font-bold text-gray-900">0</h3>
                    </div>
                    <div class="bg-green-100 p-4 rounded-lg">
                        <i class="fas fa-hotel text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Hotel Favorit</p>
                        <h3 class="text-3xl font-bold text-gray-900">0</h3>
                    </div>
                    <div class="bg-red-100 p-4 rounded-lg">
                        <i class="fas fa-heart text-2xl text-red-600"></i>
                    </div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm mb-1">Poin Reward</p>
                        <h3 class="text-3xl font-bold text-gray-900">0</h3>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <i class="fas fa-star text-2xl text-yellow-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Recent Bookings -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-gray-900">
                                <i class="fas fa-clock text-gold mr-2"></i>
                                Booking Terbaru
                            </h2>
                            <a href="{{ route('customer.bookings') }}" class="text-gold hover:text-yellow-600 font-medium">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Belum Ada Booking
                            </h3>
                            <p class="text-gray-500 mb-6">
                                Mulai jelajahi hotel-hotel terbaik dan buat booking pertama Anda
                            </p>
                            <a href="{{ route('homepage') }}" class="inline-block bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                                <i class="fas fa-search mr-2"></i>
                                Cari Hotel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recommended Hotels -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-star text-gold mr-2"></i>
                            Rekomendasi Untuk Anda
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @for($i = 1; $i <= 2; $i++)
                            <!-- Hotel Card -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400" 
                                     alt="Hotel" 
                                     class="w-full h-32 object-cover">
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-1">Grand Hotel {{ $i }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        <i class="fas fa-map-marker-alt text-gold mr-1"></i>
                                        Jakarta Pusat
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gold font-bold">Rp 500.000</span>
                                        <a href="#" class="text-sm text-gold hover:underline">
                                            Lihat Detail →
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-user-circle text-gold mr-2"></i>
                            Profil Saya
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="text-center mb-4">
                            <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-2xl font-bold text-white">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                            <h3 class="font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-phone text-gold mr-3 w-4"></i>
                                <span class="text-gray-600">{{ Auth::user()->phone ?? 'Belum diisi' }}</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-calendar text-gold mr-3 w-4"></i>
                                <span class="text-gray-600">Bergabung {{ Auth::user()->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <a href="{{ route('customer.profile') }}" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-900 py-2 rounded-lg font-medium mt-4 transition-colors">
                            Edit Profil
                        </a>
                    </div>
                </div>

                <!-- Promo Card -->
                <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl shadow-md overflow-hidden text-white p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <p class="text-sm opacity-90 mb-1">Promo Spesial</p>
                            <h3 class="text-2xl font-bold">Diskon 30%</h3>
                        </div>
                        <i class="fas fa-gift text-3xl opacity-50"></i>
                    </div>
                    <p class="text-sm opacity-90 mb-4">
                        Untuk booking pertama Anda di hotel pilihan
                    </p>
                    <button class="w-full bg-white text-purple-600 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Gunakan Sekarang
                    </button>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-link text-gold mr-2"></i>
                            Link Cepat
                        </h2>
                    </div>
                    <div class="p-4">
                        <a href="{{ route('customer.bookings') }}" class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-calendar-check text-gold mr-3 w-5"></i>
                            <span class="text-gray-700">Booking Saya</span>
                        </a>
                        <a href="#" class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-heart text-gold mr-3 w-5"></i>
                            <span class="text-gray-700">Favorit</span>
                        </a>
                        <a href="#" class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-headset text-gold mr-3 w-5"></i>
                            <span class="text-gray-700">Bantuan</span>
                        </a>
                        <a href="#" class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors">
                            <i class="fas fa-cog text-gold mr-3 w-5"></i>
                            <span class="text-gray-700">Pengaturan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection