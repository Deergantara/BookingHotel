<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Allure - Hotel Terpercaya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #0a0a0a;
            --secondary: #1a1a1a;
            --accent: #d4af37;
            --accent-light: #f7ef8a;
            --light: #f5f5f5;
            --text-dark: #333333;
            --text-light: #f5f5f5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--text-dark);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
        }

        .gradient-overlay {
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.85) 0%, rgba(26, 26, 26, 0.75) 100%);
        }

        .city-card {
            transition: all 0.3s ease;
            overflow: hidden;
            border: 1px solid #e5e5e5;
        }

        .city-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            border-color: var(--accent);
        }

        .city-image {
            transition: transform 0.5s ease;
        }

        .city-card:hover .city-image {
            transform: scale(1.05);
        }

        .facility-icon {
            transition: all 0.3s ease;
        }

        .facility-item:hover .facility-icon {
            transform: scale(1.1);
            background-color: var(--accent) !important;
            color: var(--primary) !important;
        }

        .promo-section {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            position: relative;
            overflow: hidden;
        }

        .promo-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 50%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80') center/cover no-repeat;
            opacity: 0.1;
        }

        .promo-btn {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            color: #0a0a0a;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-weight: 700;
        }

        .promo-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .promo-btn:hover::before {
            left: 100%;
        }

        .promo-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        .text-gold {
            color: #d4af37;
        }

        .plus-icon {
            transition: transform 0.3s ease;
        }

        .promo-btn:hover .plus-icon {
            transform: rotate(90deg);
        }

        .search-btn {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            color: #0a0a0a;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37, #f7ef8a);
        }

        .accent-border {
            border-color: #d4af37;
        }

        .accent-bg {
            background-color: #d4af37;
        }

        .dark-bg {
            background-color: #0a0a0a;
        }

        .medium-bg {
            background-color: #1a1a1a;
        }
    </style>
</head>
@include('layouts.app')

@section('title', 'Home - Luxury Allure')

<body class="bg-white text-gray-800">
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[560px]" style="background-image: url('{{ asset('images/hotel.jpg') }}')">
        <div class="absolute inset-0 gradient-overlay"></div>
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white px-4">
            <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold mb-4 max-w-3xl leading-tight">
                MENGINAP PENGALAMAN LENGKAP - HOTEL TERPERCAYA UNTUK MU
            </h1>
            <p class="text-xl mb-8 max-w-2xl text-gray-200">Cari untuk membandingkan Harga dan Penawaran terbaik</p>

            <!-- Form Pencarian -->
            <form action="{{ route('property.search') }}" method="GET"
                class="bg-white rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-4 px-6 py-4 w-full max-w-4xl">
                <div class="flex-1 w-full">
                    <input type="text" name="search" placeholder="Cari berdasarkan kota, hotel, atau daerah..."
                        class="w-full px-4 py-3 border-0 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Check-in</label>
                        <input type="date" name="checkin" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Check-out</label>
                        <input type="date" name="checkout" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Tamu & Kamar</label>
                        <select name="guests" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500 w-full">
                            <option value="1">1 Kamar, 1 - 4 Tamu</option>
                            <option value="2">2 Kamar, 2 - 8 Tamu</option>
                            <option value="3">3 Kamar, 3 - 12 Tamu</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 self-end md:self-auto mt-2 md:mt-0">
                        CARI
                    </button>
                </div>
            </form>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <div class="animate-bounce">
                <i class="fas fa-chevron-down text-gold text-2xl"></i>
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="dark-bg text-white py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="facility-item">
                <div class="facility-icon medium-bg w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bed text-2xl text-gold"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Kamar Nyaman</h3>
                <p class="text-gray-400 text-sm">Tempat tidur premium untuk istirahat maksimal</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon medium-bg w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-spa text-2xl text-gold"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Linen Bersih</h3>
                <p class="text-gray-400 text-sm">Linen berkualitas tinggi dengan kebersihan terjamin</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon medium-bg w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-wifi text-2xl text-gold"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">WiFi Gratis</h3>
                <p class="text-gray-400 text-sm">Koneksi internet cepat di seluruh area hotel</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon medium-bg w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl text-gold"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Fleksibel</h3>
                <p class="text-gray-400 text-sm">Waktu check-in & check-out yang fleksibel</p>
            </div>
        </div>
    </section>

    <!-- Promo Section Baru -->
    <section class="promo-section py-20">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        Kenangan<br>
                        <span class="text-gold">Indah Dimulai</span><br>
                        dari Sini
                    </h2>

                    <a href="#" class="promo-btn inline-flex items-center px-8 py-4 rounded-lg font-bold text-lg shadow-lg">
                        <span class="plus-icon mr-3 text-xl">+</span>
                        PESAN KAMAR
                    </a>
                </div>

                <div class="md:w-1/2 grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="rounded-xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105">
                            <img src="https://images.unsplash.com/photo-1582582621959-48d27397dc69?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80"
                                 alt="Luxury Suite" class="w-full h-48 object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105">
                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                 alt="Hotel Bathroom" class="w-full h-32 object-cover">
                        </div>
                    </div>
                    <div class="space-y-4 mt-8">
                        <div class="rounded-xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105">
                            <img src="https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                 alt="Hotel Lobby" class="w-full h-32 object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-lg transform transition duration-300 hover:scale-105">
                            <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                 alt="Hotel Pool" class="w-full h-48 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- City Section -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl md:text-4xl font-bold mb-4 text-gray-900 hero-title">Explore Indonesia</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan pengalaman menginap terbaik di berbagai kota menarik di Indonesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- City 1 - jakarta -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/jakarta.jpg') }}"
                             alt="jakarta" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Jakarta</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Ibu kota Indonesia dengan berbagai destinasi wisata dan bisnis</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-semibold">Mulai dari Rp 450.000</span>
                            <a href="#" class="text-gold hover:text-yellow-700 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- City 2 - Bandung -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('images/Bandung.jpg') }}"
                             alt="bandung" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Bandung</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota Kembang dengan udara sejuk dan wisata kuliner yang terkenal</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-semibold">Mulai dari Rp 350.000</span>
                            <a href="#" class="text-gold hover:text-yellow-700 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- City 3 - Palembang -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                    <img src="{{ asset('images/palembang.jpg') }}"
                             alt="Palembang" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Palembang</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota tertua di Indonesia dengan jembatan Ampera yang ikonik</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-semibold">Mulai dari Rp 320.000</span>
                            <a href="#" class="text-gold hover:text-yellow-700 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- City 4 - Surabaya -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                    <img src="{{ asset('images/surabaya.jpg') }}"
                             alt="Surabaya" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Surabaya</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota Pahlawan dengan beragam destinasi sejarah dan modern</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gold font-semibold">Mulai dari Rp 380.000</span>
                            <a href="#" class="text-gold hover:text-yellow-700 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-gold text-gold hover:bg-yellow-50 rounded-lg transition-all duration-300 font-semibold">
                    Lihat Semua Kota <i class="fas fa-chevron-down ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="section-title text-3xl font-bold mb-4 text-gray-900 hero-title">Mengapa Memilih Luxury Allure?</h2>
            <p class="mb-12 text-gray-600 max-w-2xl mx-auto text-lg">Kami menyediakan pelayanan terbaik dengan harga yang terjangkau untuk pengalaman menginap yang tak terlupakan.</p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-gold text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Lokasi Strategis</h3>
                    <p class="text-gray-600">Dekat dengan pusat kota, bandara, dan destinasi wisata utama. Mudah dijangkau dari mana saja.</p>
                </div>
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-concierge-bell text-gold text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Pelayanan Ramah</h3>
                    <p class="text-gray-600">Staf profesional dan berpengalaman siap melayani kebutuhan Anda 24 jam dengan senyuman.</p>
                </div>
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-swimming-pool text-gold text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Fasilitas Lengkap</h3>
                    <p class="text-gray-600">Mulai dari kolam renang, gym modern, spa, hingga restoran dengan menu internasional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="dark-bg text-white py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <h3 class="hero-title text-2xl font-bold mb-4 text-gold">Luxury Allure</h3>
                    <p class="text-gray-400 mb-6">Hotel mewah dengan pelayanan terbaik untuk pengalaman menginap yang tak terlupakan. Kami berkomitmen memberikan kenyamanan dan kepuasan maksimal bagi setiap tamu.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full medium-bg flex items-center justify-center hover:bg-gold transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full medium-bg flex items-center justify-center hover:bg-gold transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full medium-bg flex items-center justify-center hover:bg-gold transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full medium-bg flex items-center justify-center hover:bg-gold transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gold">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Kamar & Suite</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Restoran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Fasilitas</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gold transition-colors">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-gold">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-gold mr-3 mt-1"></i>
                            <span>Jl. Kemegahan No. 123, Jakarta Pusat</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-gold mr-3"></i>
                            <span>+62 21 1234 5678</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-gold mr-3"></i>
                            <span>info@luxuryallure.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500">
                <p>&copy; 2023 Luxury Allure. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
