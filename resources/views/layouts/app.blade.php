<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Allure Hotel</title>
    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Font Awesome untuk icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- Header / Navbar --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Luxury Allure" class="h-8">
                <span class="font-bold text-lg text-blue-800">Luxury Allure</span>
            </a>

            {{-- Menu --}}
            <nav class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
                <a href="#" class="hover:text-blue-600">Fasilitas</a>
                <a href="#" class="hover:text-blue-600">Tentang Kami</a>
                <a href="#" class="hover:text-blue-600">Kontak</a>
            </nav>

            {{-- Login/Register --}}
            <div>
                <a href="{{ route('login') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Masuk</a>
                <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Daftar</a>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-blue-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">
            <div>
                <h3 class="font-bold text-lg mb-2">Luxury Allure</h3>
                <p class="text-gray-300 text-sm">Nikmati pengalaman menginap terbaik dengan pelayanan profesional.</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Navigasi</h3>
                <ul class="text-gray-300 text-sm space-y-1">
                    <li><a href="#" class="hover:underline">Beranda</a></li>
                    <li><a href="#" class="hover:underline">Fasilitas</a></li>
                    <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                    <li><a href="#" class="hover:underline">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Kontak</h3>
                <p class="text-gray-300 text-sm">Jl. Contoh No.123, Sukabumi</p>
                <p class="text-gray-300 text-sm">Telp: +62 812-3456-7890</p>
                <p class="text-gray-300 text-sm">Email: info@luxuryallure.com</p>
            </div>
        </div>
        <div class="bg-blue-950 text-center py-3 text-sm text-gray-400">
            &copy; {{ date('Y') }} Luxury Allure. Semua Hak Dilindungi.
        </div>
    </footer>

</body>
</html>
