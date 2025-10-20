@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-100 py-12">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Luxury Allure" class="mx-auto h-12 mb-2">
            <h2 class="text-2xl font-bold text-blue-800">Masuk ke Akun</h2>
            <p class="text-gray-500 text-sm">Selamat datang kembali di Luxury Allure</p>
        </div>

        {{-- Form Login --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    <span class="text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
                Masuk
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a>
        </p>
    </div>
</section>
@endsection
