@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-3xl shadow-2xl mb-6">
                <i class="fas fa-handshake text-3xl text-gray-900"></i>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 mb-4 font-playfair">Bergabung dengan Luxury Allure</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Mari bekerja sama untuk memberikan pengalaman menginap terbaik kepada tamu. Isi form berikut untuk memulai kemitraan.
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-8 p-6 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl shadow-lg transform transition-all duration-300 hover:scale-105">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-1">Berhasil!</h3>
                    <p class="text-green-100">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white rounded-3xl shadow-2xl border border-gray-200 overflow-hidden">
            <form method="POST" action="{{ route('work.with.us.store') }}" class="p-8">
                @csrf

                <!-- Data Diri Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-gray-900 to-black rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-user text-xl text-yellow-400"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 font-playfair">Data Diri</h2>
                            <p class="text-gray-600 text-lg">Informasi pribadi pemilik atau perwakilan hotel</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Nama Lengkap -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-signature text-yellow-500"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="Masukkan nama lengkap Anda" required>
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-envelope text-yellow-500"></i>
                                Alamat Email
                            </label>
                            <input type="email" name="email" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="email@contoh.com" required>
                        </div>

                        <!-- No. Telepon -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-phone text-yellow-500"></i>
                                No. Telepon
                            </label>
                            <input type="text" name="phone" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="+62 812-3456-7890" required>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-lock text-yellow-500"></i>
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password" 
                                       class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg pr-12"
                                       placeholder="Buat password yang kuat" required>
                                <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-yellow-500 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-lock text-yellow-500"></i>
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" 
                                       class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg pr-12"
                                       placeholder="Ulangi password Anda" required>
                                <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-yellow-500 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="relative mb-12">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-6 text-2xl">🎯</span>
                    </div>
                </div>

                <!-- Data Hotel Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-gray-900 to-black rounded-2xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-hotel text-xl text-yellow-400"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 font-playfair">Data Hotel</h2>
                            <p class="text-gray-600 text-lg">Informasi lengkap tentang properti hotel Anda</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Nama Hotel -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-building text-yellow-500"></i>
                                Nama Hotel
                            </label>
                            <input type="text" name="hotel_nama" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="Nama resmi hotel Anda" required>
                        </div>

                        <!-- Nomor TDUP -->
                        <div class="space-y-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-file-alt text-yellow-500"></i>
                                Nomor TDUP
                                <span class="text-sm font-normal text-gray-500">(Opsional)</span>
                            </label>
                            <input type="text" name="hotel_tdup" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="Nomor TDUP hotel">
                        </div>

                        <!-- NPWP Hotel -->
                        <div class="space-y-2 lg:col-span-2">
                            <label class="block text-lg font-semibold text-gray-700 flex items-center gap-2">
                                <i class="fas fa-receipt text-yellow-500"></i>
                                NPWP Hotel
                            </label>
                            <input type="text" name="hotel_npwp" 
                                   class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-4 focus:ring-yellow-100 transition-all duration-200 text-lg"
                                   placeholder="Nomor Pokok Wajib Pajak hotel" required>
                            <p class="text-sm text-gray-500 mt-2 flex items-center gap-2">
                                <i class="fas fa-info-circle text-yellow-500"></i>
                                Pastikan NPWP sudah terdaftar dan valid
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" 
                            class="inline-flex items-center gap-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-gray-900 font-bold text-xl py-6 px-16 rounded-2xl transition-all duration-300 transform hover:-translate-y-2 shadow-2xl hover:shadow-3xl">
                        <i class="fas fa-paper-plane text-2xl"></i>
                        Daftar Sekarang
                    </button>
                    
                    <p class="text-gray-600 text-lg mt-6 max-w-2xl mx-auto">
                        Dengan mengisi form ini, Anda menyetujui 
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-semibold underline">Syarat & Ketentuan</a> 
                        dan 
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-semibold underline">Kebijakan Privasi</a> 
                        kami.
                    </p>
                </div>
            </form>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg border border-gray-200">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tingkatkan Penghasilan</h3>
                <p class="text-gray-600">Akses ke jutaan traveler yang mencari pengalaman menginap terbaik</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg border border-gray-200">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tools text-2xl text-green-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tools Manajemen</h3>
                <p class="text-gray-600">Kelola kamar, harga, dan pemesanan dengan dashboard yang mudah digunakan</p>
            </div>
            
            <div class="text-center p-6 bg-white rounded-2xl shadow-lg border border-gray-200">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-2xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Dukungan 24/7</h3>
                <p class="text-gray-600">Tim support kami siap membantu kapan saja Anda membutuhkan</p>
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
    
    /* Custom focus styles */
    input:focus {
        outline: none;
    }
    
    /* Password toggle functionality */
    .password-toggle {
        cursor: pointer;
        transition: all 0.3s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const passwordToggles = document.querySelectorAll('button[type="button"]');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
        
        // Add animations to form elements
        const formElements = document.querySelectorAll('input, button');
        formElements.forEach((element, index) => {
            element.classList.add('animate-fade-in-up');
            element.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Form validation enhancement
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                confirmPassword.focus();
            }
        });
    });
</script>
@endsection