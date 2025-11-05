<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Booking - Luxury Allure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary: #0a0a0a;
            --primary-light: #1a1a1a;
            --accent: #d4af37;
            --accent-light: #f7ef8a;
            --secondary: #f8f9fa;
            --text: #202124;
            --text-light: #5f6368;
            --border: #e5e7eb;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }

        .font-playfair {
            font-family: 'Playfair Display', serif;
        }

        .booking-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .status-confirmed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .status-pending {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .status-completed {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .info-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            border-left: 4px solid var(--accent);
            padding-left: 12px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--accent);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 6px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--accent);
            border: 2px solid white;
            box-shadow: 0 0 0 2px var(--accent);
        }
    </style>
</head>
<body>
    <div class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-gray-900 mb-4 font-playfair">Detail Booking</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Informasi lengkap mengenai reservasi Anda di Luxury Allure
                </p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Main Booking Information -->
                <div class="xl:col-span-2 space-y-6">
                    <!-- Booking Summary Card -->
                    <div class="info-card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-3xl font-bold text-gray-900 font-playfair">Ringkasan Booking</h2>
                            <div class="status-badge status-{{ strtolower($booking->status) }}">
                                {{ ucfirst($booking->status) }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Property Information -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-hotel text-xl text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Properti</label>
                                        <p class="text-lg font-bold text-gray-900">{{ $booking->property->nama ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-bed text-xl text-blue-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Tipe Kamar</label>
                                        <p class="text-lg font-bold text-gray-900">{{ $booking->kamar->tipeKamar->nama_tipe ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Information -->
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-xl text-green-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Check-in</label>
                                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d F Y') }}</p>
                                        <p class="text-sm text-gray-500">14:00 WIB</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-times text-xl text-red-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Check-out</label>
                                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->checkout_date)->format('d F Y') }}</p>
                                        <p class="text-sm text-gray-500">12:00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Duration Calculation -->
                        <div class="mt-6 p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-xl border border-yellow-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-moon text-yellow-600 text-xl"></i>
                                    <span class="text-lg font-semibold text-gray-700">Durasi Menginap</span>
                                </div>
                                <span class="text-xl font-bold text-yellow-700">
                                    {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} Malam
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    @if($booking->payment)
                    <div class="info-card p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-credit-card text-yellow-500"></i>
                            Informasi Pembayaran
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-wallet text-xl text-purple-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Metode Pembayaran</label>
                                        <p class="text-lg font-bold text-gray-900">{{ $booking->payment->metode ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-info-circle text-xl text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-500 mb-1">Status Pembayaran</label>
                                        <p class="text-lg font-bold text-gray-900">{{ $booking->payment->status ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Proof -->
                            @if($booking->payment->bukti_pembayaran)
                            <div class="space-y-4">
                                <div class="p-4 bg-gray-50 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-500 mb-3">Bukti Pembayaran</label>
                                    <div class="relative group">
                                        <img src="{{ asset('storage/bukti/' . $booking->payment->bukti_pembayaran) }}"
                                             alt="Bukti Pembayaran"
                                             class="w-full h-48 object-cover rounded-lg shadow-md transition-all duration-300 group-hover:scale-105">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 rounded-lg flex items-center justify-center">
                                            <a href="{{ asset('storage/bukti/' . $booking->payment->bukti_pembayaran) }}"
                                               target="_blank"
                                               class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white bg-opacity-90 p-3 rounded-full shadow-lg">
                                                <i class="fas fa-expand text-gray-700 text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2 text-center">Klik untuk melihat ukuran penuh</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar Information -->
                <div class="space-y-6">
                    <!-- Booking Timeline -->
                    <div class="info-card p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-history text-yellow-500"></i>
                            Timeline Booking
                        </h3>

                        <div class="timeline">
                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Booking Dibuat</p>
                                <p class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                            </div>

                            @if($booking->payment)
                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Pembayaran Diproses</p>
                                <p class="text-sm text-gray-500">{{ $booking->payment->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            @endif

                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Check-in</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->checkin_date)->format('d M Y') }}, 14:00 WIB</p>
                            </div>

                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Check-out</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->checkout_date)->format('d M Y') }}, 12:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="info-card p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-bolt text-yellow-500"></i>
                            Tindakan Cepat
                        </h3>

                        <div class="space-y-3">
                            <a href="{{ route('booking.index') }}"
                               class="w-full flex items-center gap-3 p-3 text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-arrow-left text-gray-500"></i>
                                <span class="font-semibold">Kembali ke Daftar</span>
                            </a>

                            @if($booking->status == 'pending')
                            <button class="w-full flex items-center gap-3 p-3 text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-credit-card text-blue-500"></i>
                                <span class="font-semibold">Lanjutkan Pembayaran</span>
                            </button>
                            @endif

                            <button class="w-full flex items-center gap-3 p-3 text-green-700 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-print text-green-500"></i>
                                <span class="font-semibold">Cetak Invoice</span>
                            </button>

                            <button class="w-full flex items-center gap-3 p-3 text-red-700 bg-red-50 hover:bg-red-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-times text-red-500"></i>
                                <span class="font-semibold">Batalkan Booking</span>
                            </button>
                        </div>
                    </div>

                    <!-- Support Information -->
                    <div class="info-card p-6 bg-gradient-to-r from-gray-900 to-black text-white">
                        <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                            <i class="fas fa-headset text-yellow-400"></i>
                            Butuh Bantuan?
                        </h3>
                        <p class="text-gray-300 mb-4">Tim support kami siap membantu 24/7</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-yellow-400"></i>
                                <span class="font-semibold">+62 21 1234 5678</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-yellow-400"></i>
                                <span class="font-semibold">support@luxuryallure.com</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-comment text-yellow-400"></i>
                                <span class="font-semibold">Live Chat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth animations
            const cards = document.querySelectorAll('.info-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Print functionality
            document.querySelector('button:contains("Cetak Invoice")')?.addEventListener('click', function() {
                window.print();
            });
        });
    </script>
</body>
</html>
