@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Profil Saya</h2>
            <a href="{{ route('account.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                Edit Profil
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-600 font-medium mb-1">Nama Lengkap</label>
                <p class="text-gray-900 font-semibold">{{ $user->name }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Email</label>
                <p class="text-gray-900 font-semibold">{{ $user->email }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Nomor Telepon</label>
                <p class="text-gray-900 font-semibold">{{ $user->phone ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Nomor Identitas</label>
                <p class="text-gray-900 font-semibold">{{ $user->nomor_identitas ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Tanggal Lahir</label>
                <p class="text-gray-900 font-semibold">{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d M Y') : '-' }}</p>
            </div>

            <div>
                <label class="block text-gray-600 font-medium mb-1">Member Sejak</label>
                <p class="text-gray-900 font-semibold">{{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
