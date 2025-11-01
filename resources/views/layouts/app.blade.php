<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hotel Booking - Luxury Allure')</title>
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

        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
            margin-top: 8px;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f9f9f9;
            padding-left: 20px;
        }

        .dropdown-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .dropdown-item.logout {
            color: #dc2626;
        }

        .dropdown-item.logout:hover {
            background-color: #fee;
        }

        /* Flash Message Styles */
        .alert {
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d1fae5;
            border-left: 4px solid #10b981;
            color: #065f46;
        }

        .alert-error {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
        }

        .alert-warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            color: #92400e;
        }

        .alert-info {
            background-color: #dbeafe;
            border-left: 4px solid #3b82f6;
            color: #1e40af;
        }

        .alert i {
            margin-right: 12px;
            font-size: 20px;
        }

        .alert-close {
            margin-left: auto;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* User Badge */
        .user-badge {
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            color: #0a0a0a;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <header class="navbar-gradient text-white shadow-lg">
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Bar -->
            <div class="flex items-center justify-between py-2">
                <!-- Left Section -->
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-sm text-gray-300">
                            <i class="fas fa-user-circle text-gold mr-1"></i>
                            Halo, <span class="text-gold font-medium">{{ Auth::user()->name }}</span>
                        </span>
                    @endauth
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-headset mr-1"></i> Bantuan
                    </a>
                    <span class="text-gray-500">|</span>
                    
                    @guest
                        <a href="{{ route('login') }}" class="text-sm hover-gold transition-smooth">
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}" class="text-sm gold-gradient text-gray-900 px-3 py-1 rounded-lg font-medium hover:shadow-lg transition-smooth">
                            <i class="fas fa-user-plus mr-1"></i> Daftar
                        </a>
                    @else
                        <div class="dropdown">
                            <button class="user-btn flex items-center space-x-2 px-3 py-2 rounded-lg">
                                <i class="fas fa-user-circle text-xl text-gold"></i>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gold"></i>
                            </button>
                            
                            <div class="dropdown-menu">
                                <a href="{{ route('customer.profile') }}" class="dropdown-item">
                                    <i class="fas fa-user text-gold"></i>
                                    <span>Profil Saya</span>
                                </a>
                                <a href="{{ route('customer.bookings') }}" class="dropdown-item">
                                    <i class="fas fa-calendar-check text-gold"></i>
                                    <span>Booking Saya</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-heart text-gold"></i>
                                    <span>Favorit</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-cog text-gold"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout w-full text-left">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>

            <!-- Main Navigation -->
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('homepage') }}" class="flex items-center">
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
                    <button class="user-btn flex items-center space-x-1 px-3 py-2 rounded-lg" onclick="toggleDarkMode()">
                        <i class="fas fa-moon text-gold"></i>
                        <span>Mode Gelap</span>
                    </button>
                    
                    @guest
                        <a href="{{ route('login') }}" class="user-btn flex items-center space-x-1 px-3 py-2 rounded-lg">
                            <i class="fas fa-user-circle text-xl text-gold"></i>
                            <span>Akun</span>
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Secondary Navigation -->
            <div class="flex items-center justify-between py-3 border-t border-gray-700">
                <div class="flex items-center space-x-6">
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-bed mr-2 text-gold"></i> Hotel
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-car mr-2 text-gold"></i> Parking
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-umbrella-beach mr-2 text-gold"></i> Pemandangan
                    </a>
                </div>

                <div class="flex items-center space-x-6">
                    <a href="{{ route('work.with.us') }}" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-crown mr-2 text-gold"></i> Work With Us
                    </a>
                    <a href="#" class="nav-item text-sm hover-gold transition-smooth flex items-center">
                        <i class="fas fa-list mr-2 text-gold"></i> Daftar Hotel Saya
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('warning') || session('info'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            @if(session('success'))
                <div class="alert alert-success" id="flash-message">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button class="alert-close" onclick="closeAlert()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error" id="flash-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                    <button class="alert-close" onclick="closeAlert()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning" id="flash-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('warning') }}</span>
                    <button class="alert-close" onclick="closeAlert()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info" id="flash-message">
                    <i class="fas fa-info-circle"></i>
                    <span>{{ session('info') }}</span>
                    <button class="alert-close" onclick="closeAlert()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>


    <!-- Scripts -->
    <script>
        // Auto close flash messages after 5 seconds
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.animation = 'slideUp 0.4s ease';
                setTimeout(() => flashMessage.remove(), 400);
            }
        }, 5000);

        // Manual close flash message
        function closeAlert() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.animation = 'slideUp 0.4s ease';
                setTimeout(() => flashMessage.remove(), 400);
            }
        }

        // Dark mode toggle (optional)
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            // Save preference to localStorage
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark);
        }

        // Load dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.body.classList.add('dark-mode');
        }

        // Add slideUp animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')
</body>
</html>