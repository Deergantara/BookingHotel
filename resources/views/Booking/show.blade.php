<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembayaran</title>
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

        .voucher-header {
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

        .print-section {
            background-color: #f9fafb;
            border: 1px dashed #d1d5db;
            border-radius: 8px;
            padding: 16px;
            margin-top: 24px;
        }

        .hotel-name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .room-type {
            font-size: 1.125rem;
            color: #374151;
            margin-bottom: 16px;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }

        .detail-label {
            width: 140px;
            font-weight: 600;
            color: #4b5563;
        }

        .detail-value {
            flex: 1;
            color: #1f2937;
        }

        .promo-section {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 1px solid #fbbf24;
            border-radius: 8px;
            padding: 16px;
            margin-top: 16px;
        }

        .payment-method {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 16px;
            margin-top: 16px;
        }

        .signature-section {
            margin-top: 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }

        .footer {
            background-color: #1f2937;
            color: white;
            padding: 24px;
            margin-top: 40px;
            border-radius: 8px;
        }

        @media print {
            body {
                background: white;
            }
            .no-print {
                display: none;
            }
            .info-card {
                box-shadow: none;
                border: 1px solid #e5e7eb;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2 font-playfair">HOTEL VOUCHER</h1>
                <div class="print-section">
                    <p class="text-lg font-semibold text-gray-700">
                        <i class="fas fa-print mr-2"></i>
                        Tolong CETAK Voucher ini dan bawa ketika CHECK IN di HOTEL
                    </p>
                    <p class="text-lg font-semibold text-gray-700 mt-2">
                        <i class="fas fa-credit-card mr-2"></i>
                        Bawalah Kartu Kredit Anda jika Anda membayar dengan Kartu Kredit
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                <!-- Main Voucher Information -->
                <div class="space-y-6">
                    <!-- Booking Details Card -->
                    <div class="info-card p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Detail Pemesanan</h2>
                            <div class="status-badge status-confirmed">
                                CONFIRMED
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-4">
                                <div class="detail-row">
                                    <div class="detail-label">Order ID</div>
                                    <div class="detail-value font-semibold">#43579424</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Nama Tamu</div>
                                    <div class="detail-value">Marselina Jawa</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Tanggal</div>
                                    <div class="detail-value">26/03/2018</div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="detail-row">
                                    <div class="detail-label">Item Number</div>
                                    <div class="detail-value">65858411</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Negara</div>
                                    <div class="detail-value">Indonesia</div>
                                </div>
                                <div class="detail-row">
                                    <div class="detail-label">Booked by</div>
                                    <div class="detail-value">Travelscape LLC: 304061356</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 section-title">DETIL HOTEL</h3>

                            <div class="hotel-name">D Lima Hotel and Villa</div>
                            <div class="room-type">Kamar Superior - Non Refundable</div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div class="space-y-4">
                                    <div class="detail-row">
                                        <div class="detail-label">Alamat</div>
                                        <div class="detail-value">Jalan Pura Mertasari 2 No. 9 Sunset Road</div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-label">Tgl Masuk</div>
                                        <div class="detail-value font-semibold">11 April 2018</div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-label">Tgl Keluar</div>
                                        <div class="detail-value font-semibold">14 April 2018</div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="detail-row">
                                        <div class="detail-label">Jumlah Kamar</div>
                                        <div class="detail-value">1</div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-label">Dewasa</div>
                                        <div class="detail-value">2</div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-label">Anak-Anak</div>
                                        <div class="detail-value">0</div>
                                    </div>
                                    <div class="detail-row">
                                        <div class="detail-label">Sarapan</div>
                                        <div class="detail-value">Ya, Termasuk</div>
                                    </div>
                                </div>
                            </div>

                            <div class="promo-section">
                                <div class="detail-row">
                                    <div class="detail-label">Promosi</div>
                                    <div class="detail-value">Promo Code : TIKETFAIR150 Promo Code Worth IDR 150.000,00</div>
                                </div>
                                <div class="detail-row mt-2">
                                    <div class="detail-label">Tambahan Promosi</div>
                                    <div class="detail-value">Sarapan Lengkap, Gratis Parkir, Gratis Internet Nirkabel</div>
                                </div>
                            </div>

                            <div class="payment-method">
                                <div class="detail-row">
                                    <div class="detail-label">Metode Pembayaran</div>
                                    <div class="detail-value">Virtual Account BCA, PROMOCODE</div>
                                </div>
                            </div>
                        </div>

                        <div class="signature-section">
                            <p class="text-lg font-semibold text-gray-700 mb-8">Tanda Tangan dan Stempel Resmi</p>
                            <div class="h-24 border-b border-gray-400 w-3/4 mx-auto"></div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Information -->
                <div class="space-y-6">
                    <!-- Booking Timeline -->
                    <div class="info-card p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-history text-yellow-500"></i>
                            Timeline Pemesanan
                        </h3>

                        <div class="timeline">
                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Pemesanan Dibuat</p>
                                <p class="text-sm text-gray-500">26 Maret 2018</p>
                            </div>

                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Check-in</p>
                                <p class="text-sm text-gray-500">11 April 2018, 14:00 WIB</p>
                            </div>

                            <div class="timeline-item">
                                <p class="font-semibold text-gray-900">Check-out</p>
                                <p class="text-sm text-gray-500">14 April 2018, 12:00 WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="info-card p-6 no-print">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <i class="fas fa-bolt text-yellow-500"></i>
                            Tindakan Cepat
                        </h3>

                        <div class="space-y-3">
                            <button onclick="window.print()" class="w-full flex items-center gap-3 p-3 text-green-700 bg-green-50 hover:bg-green-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-print text-green-500"></i>
                                <span class="font-semibold">Cetak Voucher</span>
                            </button>

                            <button class="w-full flex items-center gap-3 p-3 text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-download text-blue-500"></i>
                                <span class="font-semibold">Unduh PDF</span>
                            </button>

                            <button class="w-full flex items-center gap-3 p-3 text-red-700 bg-red-50 hover:bg-red-100 rounded-xl transition-all duration-200">
                                <i class="fas fa-times text-red-500"></i>
                                <span class="font-semibold">Batalkan Pemesanan</span>
                            </button>
                        </div>
                    </div>

                    <!-- Support Information -->
                    <div class="info-card p-6 bg-gradient-to-r from-gray-900 to-black text-white">
                        <h3 class="text-xl font-bold mb-3 flex items-center gap-2">
                            <i class="fas fa-headset text-yellow-400"></i>
                            Butuh Bantuan?
                        </h3>
                        <p class="text-gray-300 mb-4">Tim support kami siap membantu</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-yellow-400"></i>
                                <span class="font-semibold">0804 1500 878</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-yellow-400"></i>
                                <span class="font-semibold">mrdeerhardiansyah6@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer text-center mt-8">
                <h3 class="text-xl font-bold mb-2">PT. Global Tiket Network</h3>
                <p class="text-gray-300">Jl. Kawi No 45, RT 006 RW 002, Setiabudi - Jakarta Selatan, DKI Jakarta - 12980</p>
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
        });
    </script>
</body>
</html>
