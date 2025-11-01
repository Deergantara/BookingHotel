@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            <!-- Sidebar Menu - Lebar -->
            <div class="xl:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden h-full">
                    <!-- User Avatar Section -->
                    <div class="bg-gradient-to-r from-gray-900 to-black p-8 text-center">
                        <div class="relative inline-block">
                            <div class="w-32 h-32 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl">
                                <i class="fas fa-user text-4xl text-gray-900"></i>
                            </div>
                            <div class="absolute bottom-4 right-4 w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ Auth::user()->name }}</h3>
                        <p class="text-gray-300 text-lg">{{ Auth::user()->email }}</p>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-4 py-2 bg-yellow-500 text-gray-900 rounded-full text-sm font-semibold">
                                <i class="fas fa-shield-alt mr-2"></i>
                                {{ ucfirst(Auth::user()->role) }}
                            </span>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="p-6">
                        <nav class="space-y-3">
                            <a href="#" class="flex items-center gap-4 p-4 text-gray-700 bg-yellow-50 rounded-xl border-2 border-yellow-200 transition-all duration-200 hover:shadow-lg">
                                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-lg text-white"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-lg block">Profil Saya</span>
                                    <span class="text-sm text-gray-600">Kelola informasi pribadi</span>
                                </div>
                                <i class="fas fa-chevron-right ml-auto text-yellow-500"></i>
                            </a>
                            
                            <a href="#" class="flex items-center gap-4 p-4 text-gray-600 hover:bg-gray-50 rounded-xl border-2 border-gray-100 transition-all duration-200 hover:shadow-lg">
                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-calendar text-lg text-white"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-lg block">Riwayat Booking</span>
                                    <span class="text-sm text-gray-600">Lihat semua pemesanan</span>
                                </div>
                                <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                            </a>
                            
                            <a href="#" class="flex items-center gap-4 p-4 text-gray-600 hover:bg-gray-50 rounded-xl border-2 border-gray-100 transition-all duration-200 hover:shadow-lg">
                                <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-heart text-lg text-white"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-lg block">Favorit Saya</span>
                                    <span class="text-sm text-gray-600">Hotel yang disukai</span>
                                </div>
                                <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                            </a>
                            
                            <a href="#" class="flex items-center gap-4 p-4 text-gray-600 hover:bg-gray-50 rounded-xl border-2 border-gray-100 transition-all duration-200 hover:shadow-lg">
                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-cog text-lg text-white"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-lg block">Pengaturan</span>
                                    <span class="text-sm text-gray-600">Preferensi akun</span>
                                </div>
                                <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content Area - Lebar -->
            <div class="xl:col-span-3">
                <!-- Profile Information Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-gray-900 to-black px-8 py-6">
                        <h2 class="text-3xl font-bold text-white flex items-center gap-3">
                            <i class="fas fa-id-card text-yellow-400"></i>
                            Informasi Profil Lengkap
                        </h2>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div class="col-span-1 lg:col-span-2">
                                <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border-2 border-gray-200 hover:border-yellow-300 transition-all duration-200">
                                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-user-tag text-2xl text-yellow-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-lg font-semibold text-gray-500 mb-2">Nama Lengkap</label>
                                        <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                    </div>
                                    <button class="w-12 h-12 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl flex items-center justify-center shadow-md transition-all duration-200 transform hover:scale-110">
                                        <i class="fas fa-edit text-lg"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border-2 border-gray-200 hover:border-yellow-300 transition-all duration-200">
                                <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-envelope text-2xl text-yellow-600"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-lg font-semibold text-gray-500 mb-2">Alamat Email</label>
                                    <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->email }}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span class="text-sm font-semibold text-green-600">Email terverifikasi</span>
                                    </div>
                                </div>
                                <button class="w-12 h-12 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl flex items-center justify-center shadow-md transition-all duration-200 transform hover:scale-110">
                                    <i class="fas fa-edit text-lg"></i>
                                </button>
                            </div>

                            <!-- Role Field -->
                            <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border-2 border-gray-200 hover:border-yellow-300 transition-all duration-200">
                                <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-user-shield text-2xl text-yellow-600"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-lg font-semibold text-gray-500 mb-2">Peran Pengguna</label>
                                    <div class="flex items-center gap-3">
                                        <span class="px-4 py-2 bg-yellow-500 text-gray-900 rounded-xl text-lg font-bold shadow-md">
                                            {{ ucfirst(Auth::user()->role) }}
                                        </span>
                                        <span class="text-lg text-gray-600 font-semibold">• Status Aktif</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Member Since -->
                            <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border-2 border-gray-200 hover:border-yellow-300 transition-all duration-200">
                                <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-calendar-plus text-2xl text-yellow-600"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="block text-lg font-semibold text-gray-500 mb-2">Bergabung Sejak</label>
                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ Auth::user()->created_at->format('d F Y') }}
                                    </p>
                                    <p class="text-lg text-gray-600 font-semibold mt-2">
                                        {{ Auth::user()->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Section -->
                <div class="mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-chart-line text-yellow-500"></i>
                        Statistik Akun
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                                <i class="fas fa-calendar-check text-3xl text-blue-600"></i>
                            </div>
                            <h3 class="text-4xl font-bold text-gray-900 mb-2">12</h3>
                            <p class="text-xl font-semibold text-gray-600">Total Booking</p>
                            <div class="mt-3 text-sm text-green-600 font-semibold">
                                <i class="fas fa-arrow-up mr-1"></i>
                                3 bulan terakhir
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                                <i class="fas fa-star text-3xl text-green-600"></i>
                            </div>
                            <h3 class="text-4xl font-bold text-gray-900 mb-2">24</h3>
                            <p class="text-xl font-semibold text-gray-600">Ulasan Diberikan</p>
                            <div class="mt-3 text-sm text-green-600 font-semibold">
                                <i class="fas fa-check mr-1"></i>
                                Aktif memberikan ulasan
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-20 h-20 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-md">
                                <i class="fas fa-heart text-3xl text-purple-600"></i>
                            </div>
                            <h3 class="text-4xl font-bold text-gray-900 mb-2">8</h3>
                            <p class="text-xl font-semibold text-gray-600">Hotel Favorit</p>
                            <div class="mt-3 text-sm text-green-600 font-semibold">
                                <i class="fas fa-plus mr-1"></i>
                                Terus bertambah
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons Section -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <i class="fas fa-cogs text-yellow-500"></i>
                        Tindakan Cepat
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-6 px-8 rounded-2xl transition-all duration-300 transform hover:-translate-y-2 shadow-lg hover:shadow-2xl flex items-center justify-center gap-4 text-xl">
                            <i class="fas fa-sign-out-alt text-2xl"></i>
                            Keluar dari Akun
                        </a>
                    </div>
                    
                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-lg">
                            Butuh bantuan? 
                            <a href="#" class="text-yellow-600 hover:text-yellow-700 font-semibold underline">
                                Hubungi Customer Service
                            </a>
                        </p>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .font-playfair {
        font-family: 'Playfair Display', serif;
    }
    
    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #d4af37;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #b8941f;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth animations to all cards
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.classList.add('animate-fade-in-up');
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Add hover effects to interactive elements
        const interactiveElements = document.querySelectorAll('a, button');
        interactiveElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s ease';
            });
        });
    });
</script>
@endsection