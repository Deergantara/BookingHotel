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
            --primary: #1a365d;
            --secondary: #2d3748;
            --accent: #d4af37;
            --light: #f7fafc;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-title {
            font-family: 'Playfair Display', serif;
        }
        
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(26, 54, 93, 0.85) 0%, rgba(45, 55, 72, 0.75) 100%);
        }
        
        .city-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .city-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
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
            color: var(--accent);
        }
        
        .promo-section {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
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
            color: #1a365d;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
    </style>
</head>

<body class="bg-white text-gray-800">
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('{{ asset('images/hotel.jpg') }}')">
        <div class="absolute inset-0 gradient-overlay"></div>
        <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white px-4">
            <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-bold mb-4 max-w-3xl leading-tight">
                MENGINAP PENGALAMAN LENGKAP - HOTEL TERPERCAYA UNTUK MU
            </h1>
            <p class="text-xl mb-8 max-w-2xl">Cari untuk membandingkan Harga dan Penawaran terbaik</p>

            <!-- Form Pencarian -->
            <form action="{{ route('property.search') }}" method="GET"
                class="bg-white rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-4 px-6 py-4 w-full max-w-4xl">
                <div class="flex-1 w-full">
                    <input type="text" name="search" placeholder="Cari berdasarkan kota, hotel, atau daerah..."
                        class="w-full px-4 py-3 border-0 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Check-in</label>
                        <input type="date" name="checkin" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Check-out</label>
                        <input type="date" name="checkout" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Tamu & Kamar</label>
                        <select name="guests" class="px-4 py-3 border-0 rounded-lg text-gray-700 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 w-full">
                            <option value="1">1 Kamar, 1 - 4 Tamu</option>
                            <option value="2">2 Kamar, 2 - 8 Tamu</option>
                            <option value="3">3 Kamar, 3 - 12 Tamu</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-300 self-end md:self-auto mt-2 md:mt-0">
                        CARI
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <div class="animate-bounce">
                <i class="fas fa-chevron-down text-white text-2xl"></i>
            </div>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="bg-blue-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="facility-item">
                <div class="facility-icon bg-blue-800 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bed text-2xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Kamar Nyaman</h3>
                <p class="text-blue-200 text-sm">Tempat tidur premium untuk istirahat maksimal</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon bg-blue-800 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-spa text-2xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Linen Bersih</h3>
                <p class="text-blue-200 text-sm">Linen berkualitas tinggi dengan kebersihan terjamin</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon bg-blue-800 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-wifi text-2xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">WiFi Gratis</h3>
                <p class="text-blue-200 text-sm">Koneksi internet cepat di seluruh area hotel</p>
            </div>
            <div class="facility-item">
                <div class="facility-icon bg-blue-800 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Fleksibel</h3>
                <p class="text-blue-200 text-sm">Waktu check-in & check-out yang fleksibel</p>
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
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-blue-900 hero-title">Explore Indonesia</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Temukan pengalaman menginap terbaik di berbagai kota menarik di Indonesia</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- City 1 - Medan -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1597076888157-2b24ef306341?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             alt="Medan" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Medan</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota terbesar di Sumatera dengan kekayaan kuliner dan budaya</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-700 font-semibold">Mulai dari Rp 250.000</span>
                            <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- City 2 - Padang -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1622623548007-b1d19e17b617?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             alt="Padang" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Padang</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Surga kuliner dengan pemandangan pantai yang menakjubkan</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-700 font-semibold">Mulai dari Rp 199.000</span>
                            <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- City 3 - Palembang -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1620202008105-9f8e0a04b0d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             alt="Palembang" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Palembang</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota tertua di Indonesia dengan jembatan Ampera yang ikonik</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-700 font-semibold">Mulai dari Rp 185.000</span>
                            <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- City 4 - Surabaya -->
                <div class="city-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1588666309994-3d90ac4f44b9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                             alt="Surabaya" class="city-image w-full h-48 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <h3 class="text-xl font-bold">Surabaya</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4">Kota Pahlawan dengan beragam destinasi sejarah dan modern</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-700 font-semibold">Mulai dari Rp 220.000</span>
                            <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold flex items-center">
                                Explore Now <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-blue-700 text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-300 font-semibold">
                    Lihat Semua Kota <i class="fas fa-chevron-down ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4 text-blue-900 hero-title">Mengapa Memilih Luxury Allure?</h2>
            <p class="mb-12 text-gray-600 max-w-2xl mx-auto text-lg">Kami menyediakan pelayanan terbaik dengan harga yang terjangkau untuk pengalaman menginap yang tak terlupakan.</p>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-blue-700 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Lokasi Strategis</h3>
                    <p class="text-gray-600">Dekat dengan pusat kota, bandara, dan destinasi wisata utama. Mudah dijangkau dari mana saja.</p>
                </div>
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-concierge-bell text-blue-700 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Pelayanan Ramah</h3>
                    <p class="text-gray-600">Staf profesional dan berpengalaman siap melayani kebutuhan Anda 24 jam dengan senyuman.</p>
                </div>
                <div class="p-8 bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-swimming-pool text-blue-700 text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-4">Fasilitas Lengkap</h3>
                    <p class="text-gray-600">Mulai dari kolam renang, gym modern, spa, hingga restoran dengan menu internasional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4 hero-title">Luxury Allure</h3>
                <p class="text-blue-200">Pengalaman menginap terbaik dengan pelayanan premium dan fasilitas lengkap.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Kamar & Suite</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Promo</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Spa & Wellness</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Restoran</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Meeting Room</a></li>
                    <li><a href="#" class="text-blue-200 hover:text-white transition">Transportasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Kontak</h4>
                <ul class="space-y-2">
                    <li class="flex items-center"><i class="fas fa-map-marker-alt mr-3 text-blue-300"></i> <span class="text-blue-200">Jl. Contoh No. 123, Jakarta</span></li>
                    <li class="flex items-center"><i class="fas fa-phone mr-3 text-blue-300"></i> <span class="text-blue-200">+62 21 1234 5678</span></li>
                    <li class="flex items-center"><i class="fas fa-envelope mr-3 text-blue-300"></i> <span class="text-blue-200">info@luxuryallure.com</span></li>
                </ul>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 mt-8 pt-8 border-t border-blue-800 text-center text-blue-300">
            <p>&copy; 2023 Luxury Allure. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>