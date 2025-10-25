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
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        }
        
        .gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
        }
        
        .hover-gold:hover {
            color: #d4af37;
        }
        
        .border-gold {
            border-color: #d4af37;
        }
        
        .text-gold {
            color: #d4af37;
        }
        
        .bg-gold {
            background-color: #d4af37;
        }
        
        .bg-dark {
            background-color: #0a0a0a;
        }
        
        .bg-medium {
            background-color: #1a1a1a;
        }
        
        .transition-smooth {
            transition: all 0.3s ease;
        }
        
        .search-btn {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            color: #0a0a0a;
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }
        
        .user-btn {
            transition: all 0.3s ease;
        }
        
        .user-btn:hover {
            background-color: rgba(212, 175, 55, 0.1);
            color: #d4af37;
        }
        
        .nav-item {
            position: relative;
            padding-bottom: 8px;
        }
        
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #d4af37, #f7ef8a);
            transition: width 0.3s ease;
        }
        
        .nav-item:hover::after {
            width: 100%;
        }
        
        .logo-container {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            color: #0a0a0a;
            transition: all 0.3s ease;
        }
        
        .logo-container:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <header class="navbar-gradient text-white shadow-lg">
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Bar -->
            <div class="flex items-center justify-end py-2">
                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-headset mr-1"></i> Bantuan
                    </a>
                    <span class="text-gray-500">|</span>
                    <div class="flex items-center space-x-2">
                        <img src="https://flagcdn.com/w20/id.png" alt="Indonesia" class="w-5 h-3">
                        <span class="text-sm">ID</span>
                    </div>
                    <span class="text-gray-500">|</span>
                    <a href="#" class="text-sm hover-gold transition-smooth">Masuk</a>
                    <a href="#" class="text-sm gold-gradient text-gray-900 px-3 py-1 rounded-lg font-medium hover:shadow-lg transition-smooth">Daftar</a>
                </div>
            </div>
            
            <!-- Main Navigation -->
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="#" class="flex items-center">
                    <div class="logo-container font-bold text-xl px-3 py-2 rounded-lg mr-2">
                        <i class="fas fa-crown"></i>
                    </div>
                    <span class="text-xl font-bold text-gold">Luxury Allure</span>
                </a>
                
                <!-- Search Bar -->
                <div class="flex-1 mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Cari hotel, destinasi, atau landmark" 
                               class="w-full py-3 px-4 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 shadow-sm">
                        <button class="search-btn absolute right-2 top-1/2 transform -translate-y-1/2 p-2 rounded-lg font-medium">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- User Menu -->
                <div class="flex items-center space-x-2">
                    <button class="user-btn flex items-center space-x-1 px-3 py-2 rounded-lg">
                        <i class="fas fa-map-marker-alt text-gold"></i>
                        <span>Indonesia</span>
                    </button>
                    <button class="user-btn flex items-center space-x-1 px-3 py-2 rounded-lg">
                        <i class="fas fa-moon text-gold"></i>
                        <span>Mode Gelap</span>
                    </button>
                    <button class="user-btn flex items-center space-x-1 px-3 py-2 rounded-lg">
                        <i class="fas fa-user-circle text-xl text-gold"></i>
                        <span>Akun</span>
                    </button>
                </div>
            </div>
            
            <!-- Secondary Navigation -->
            <div class="flex items-center justify-between py-3 border-t border-gray-700">
                <div class="flex items-center space-x-6">
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-bed mr-2 text-gold"></i> Hotel
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-train mr-2 text-gold"></i> Kereta
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-car mr-2 text-gold"></i> Sewa Mobil
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-umbrella-beach mr-2 text-gold"></i> Aktivitas
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-crown mr-2 text-gold"></i> Elite Rewards
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-list mr-2 text-gold"></i> Daftar Hotel Saya
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>