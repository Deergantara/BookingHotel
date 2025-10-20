<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-gradient {
            background: linear-gradient(90deg, #1e3a8a 0%, #1e40af 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <header class="navbar-gradient text-white">
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Bar -->
            <div class="flex items-center justify-end py-2">
                
                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-headset mr-1"></i> Bantuan
                    </a>
                    <span class="text-gray-300">|</span>
                    <div class="flex items-center space-x-2">
                        <img src="https://flagcdn.com/w20/id.png" alt="Indonesia" class="w-5 h-3">
                        <span class="text-sm">ID</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="text-sm hover:underline">Masuk</a>
                    <a href="#" class="text-sm bg-white text-blue-700 px-3 py-1 rounded hover:bg-gray-100">Daftar</a>
                </div>
            </div>
            
            <!-- Main Navigation -->
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="#" class="flex items-center">
                    <div class="bg-white text-blue-700 font-bold text-xl px-3 py-2 rounded-lg mr-2">
                        H
                    </div>
                    <span class="text-xl font-bold">Luxury Allure</span>
                </a>
                
                <!-- Search Bar -->
                <div class="flex-1 mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Cari hotel, destinasi, atau landmark" 
                               class="w-full py-3 px-4 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <button class="flex items-center space-x-1 hover:bg-blue-800 px-3 py-2 rounded-lg">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Indonesia</span>
                    </button>
                    <button class="flex items-center space-x-1 hover:bg-blue-800 px-3 py-2 rounded-lg">
                        <i class="fas fa-moon"></i>
                        <span>Mode Gelap</span>
                    </button>
                    <button class="flex items-center space-x-1 hover:bg-blue-800 px-3 py-2 rounded-lg">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span>Akun</span>
                    </button>
                </div>
            </div>
            
            <!-- Secondary Navigation -->
            <div class="flex items-center justify-between py-2 border-t border-blue-400">
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-bed mr-1"></i> Hotel
                    </a>
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-plane mr-1"></i> Pesawat
                    </a>
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-train mr-1"></i> Kereta
                    </a>
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-car mr-1"></i> Sewa Mobil
                    </a>
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-umbrella-beach mr-1"></i> Aktivitas
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-crown mr-1"></i> Elite Rewards
                    </a>
                    <a href="#" class="text-sm hover:underline flex items-center">
                        <i class="fas fa-list mr-1"></i> Daftar Hotel Saya
                    </a>
                </div>
            </div>
        </div>
    </header>
    </main>

    @yield('content')
    <!-- Footer -->
    <footer class="bg-blue-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">
            <div>
                <h3 class="font-bold text-lg mb-2">Hotel.com</h3>
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
                <p class="text-gray-300 text-sm">Email: info@hotel.com</p>
            </div>
        </div>
        <div class="bg-blue-950 text-center py-3 text-sm text-gray-400">
            &copy; 2023 Hotel.com. Semua Hak Dilindungi.
        </div>
    </footer>
</body>
</html>