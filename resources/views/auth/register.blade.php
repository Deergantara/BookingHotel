@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header dengan gradien hitam-emas -->
        <div class="bg-gradient-to-r from-gray-900 to-black py-6 px-8 text-center">
            <div class="flex justify-center mb-3">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-crown text-2xl text-gray-900"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-white mb-1">Buat Akun Baru</h2>
            <p class="text-gray-300 text-sm">Gabung bersama Luxury Allure untuk pengalaman terbaik</p>
        </div>

        {{-- Form Register --}}
        <div class="p-8">
            <form action="{{ route('register') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama Lengkap Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition-all duration-200"
                            placeholder="masukkan nama lengkap"
                            value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition-all duration-200"
                            placeholder="masukkan email anda"
                            value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition-all duration-200"
                            placeholder="buat password minimal 8 karakter">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 focus:outline-none transition-all duration-200"
                            placeholder="ulangi password anda">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start gap-3">
                    <div class="relative flex-shrink-0 mt-1">
                        <input type="checkbox" name="terms" id="terms" required class="sr-only">
                        <div class="w-4 h-4 border-2 border-gray-300 rounded-sm flex items-center justify-center transition-all duration-200 checkbox-custom">
                            <i class="fas fa-check text-xs text-white opacity-0"></i>
                        </div>
                    </div>
                    <label for="terms" class="text-sm text-gray-600 cursor-pointer select-none">
                        Saya menyetujui
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium">Syarat & Ketentuan</a>
                        dan
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium">Kebijakan Privasi</a>
                    </label>
                </div>
                @error('terms')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-gray-900 py-3 rounded-lg font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    Daftar Sekarang
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold transition-colors duration-200">
                        Masuk
                    </a>
                </p>
            </div>

            <!-- Social Register (Optional) -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Atau daftar dengan</span>
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-3">
                    <button type="button" class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        <i class="fab fa-google text-red-500 mr-2"></i>
                        Google
                    </button>
                    <button type="button" class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                        Facebook
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .checkbox-custom {
        position: relative;
        cursor: pointer;
    }

    input[type="checkbox"]:checked + .checkbox-custom {
        background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
        border-color: #d4af37;
    }

    input[type="checkbox"]:checked + .checkbox-custom i {
        opacity: 1;
    }

    input:focus {
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .bg-gradient-to-br {
        background-image: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
    }

    .password-strength {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        margin-top: 4px;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Custom checkbox functionality
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const customCheckbox = this.nextElementSibling;
                if (this.checked) {
                    customCheckbox.style.background = 'linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%)';
                    customCheckbox.style.borderColor = '#d4af37';
                    customCheckbox.querySelector('i').style.opacity = '1';
                } else {
                    customCheckbox.style.background = 'transparent';
                    customCheckbox.style.borderColor = '#d1d5db';
                    customCheckbox.querySelector('i').style.opacity = '0';
                }
            });
        });

        // Password toggle functionality
        const passwordToggles = document.querySelectorAll('.password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.closest('.relative').querySelector('input');
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

        // Password strength indicator (optional enhancement)
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput) {
            // You can add password strength indicator here if needed
        }
    });
</script>
@endsection
