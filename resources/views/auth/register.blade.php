@extends('layouts.app')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-100 py-12">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Luxury Allure" class="mx-auto h-12 mb-2">
            <h2 class="text-2xl font-bold text-blue-800">Buat Akun Baru</h2>
            <p class="text-gray-500 text-sm">Gabung bersama Luxury Allure untuk pengalaman terbaik</p>
        </div>

        {{-- Form Register --}}
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

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

            <div>
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a>
        </p>
    </div>
</section>
@endsection
