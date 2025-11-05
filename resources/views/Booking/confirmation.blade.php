<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking - Luxury Allure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0a0a0a;
            --primary-light: #1a1a1a;
            --accent: #d4af37;
            --accent-light: #f7ef8a;
            --success: #22c55e;
            --text: #202124;
            --text-light: #5f6368;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }

        .header {
            background: var(--primary);
            color: white;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon i {
            font-size: 22px;
            color: var(--primary);
        }

        .logo h1 {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            color: var(--accent);
            font-family: 'Playfair Display', serif;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .success-animation {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInDown 0.6s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkmark-wrapper {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 24px;
        }

        .checkmark-circle {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
            position: relative;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .checkmark-circle i {
            font-size: 50px;
            color: var(--primary);
            animation: checkIn 0.3s ease-out 0.5s both;
        }

        @keyframes checkIn {
            from {
                opacity: 0;
                transform: scale(0);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .success-title {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 12px;
            font-family: 'Playfair Display', serif;
        }

        .success-subtitle {
            color: var(--text-light);
            font-size: 18px;
            margin-bottom: 24px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 24px;
            border: 1px solid var(--border);
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
        }

        .card-title i {
            color: var(--accent);
            font-size: 24px;
        }

        .booking-code-banner {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-bottom: 32px;
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .booking-code-label {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .booking-code {
            font-size: 36px;
            font-weight: 800;
            color: var(--primary);
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }

        .booking-code-note {
            font-size: 13px;
            color: var(--primary);
            margin-top: 8px;
            opacity: 0.8;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: var(--text-light);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-label i {
            color: var(--accent);
            width: 20px;
        }

        .detail-value {
            font-weight: 600;
            color: var(--text);
            font-size: 16px;
        }

        .total-row {
            background: rgba(212, 175, 55, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-top: 16px;
        }

        .total-label {
            font-size: 18px;
            color: var(--text);
            font-weight: 600;
        }

        .total-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--accent);
        }

        .alert {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 2px solid rgba(34, 197, 94, 0.3);
        }

        .alert-info {
            background: rgba(212, 175, 55, 0.1);
            border: 2px solid var(--accent);
        }

        .alert i {
            font-size: 24px;
            margin-top: 2px;
        }

        .alert-success i {
            color: var(--success);
        }

        .alert-info i {
            color: var(--accent);
        }

        .alert-content h4 {
            font-weight: 700;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .alert-success h4 {
            color: #16a34a;
        }

        .alert-info h4 {
            color: var(--primary);
        }

        .alert-content p {
            margin: 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .alert-success p {
            color: #15803d;
        }

        .alert-info p {
            color: var(--text-light);
        }

        .btn {
            padding: 16px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            border: none;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateY(-2px);
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 32px;
        }

        .property-preview {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .property-image {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--accent);
        }

        .property-info h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .property-location {
            color: var(--text-light);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .property-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--accent);
        }

        .contact-card {
            text-align: center;
            padding: 24px;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .contact-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--primary);
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--text);
            font-weight: 600;
        }

        .contact-item i {
            color: var(--accent);
        }

        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .container {
                margin: 24px auto;
                padding: 0 16px;
            }

            .card {
                padding: 24px 20px;
            }

            .success-title {
                font-size: 26px;
            }

            .booking-code {
                font-size: 28px;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }

            .property-preview {
                flex-direction: column;
                text-align: center;
            }

            .property-image {
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-crown"></i>
            </div>
            <h1>Luxury Allure</h1>
        </div>
    </div>

    <div class="container">
        <!-- Success Animation -->
        <div class="success-animation">
            <div class="checkmark-wrapper">
                <div class="checkmark-circle">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <h1 class="success-title">Booking Berhasil!</h1>
            <p class="success-subtitle">
                Terima kasih telah memesan di <strong>{{ $booking->property->name }}</strong>
            </p>
        </div>

        <!-- New Account Alert -->
        @if(session('is_new_user'))
        <div class="alert alert-success">
            <i class="fas fa-user-check"></i>
            <div class="alert-content">
                <h4>Akun Berhasil Dibuat!</h4>
                <p>Kami telah mengirimkan detail akun dan konfirmasi booking ke email Anda. Anda sekarang dapat melacak pesanan dan mendapatkan penawaran khusus.</p>
            </div>
        </div>
        @endif

        <!-- Booking Code Banner -->
        <div class="booking-code-banner">
            <div class="booking-code-label">Kode Booking Anda</div>
            <div class="booking-code">#BK{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div class="booking-code-note">
                <i class="fas fa-info-circle"></i>
                Simpan kode ini untuk tracking booking Anda
            </div>
        </div>

        <!-- Property Preview -->
        <div class="card">
            <div class="property-preview">
                @php
                    $photos = [];
                    if ($booking->property->foto) {
                        $decoded = is_string($booking->property->foto)
                            ? json_decode($booking->property->foto, true)
                            : $booking->property->foto;
                        if ($decoded && is_array($decoded)) {
                            $photos = $decoded;
                        }
                    }
                    $mainPhoto = count($photos) > 0 ? $photos[0] : null;
                @endphp

                @if($mainPhoto)
                    <img src="{{ asset('storage/' . $mainPhoto) }}"
                         alt="{{ $booking->property->name }}"
                         class="property-image"
                         onerror="this.src='https://via.placeholder.com/120?text=Hotel'">
                @else
                    <img src="https://via.placeholder.com/120?text=Hotel"
                         alt="Hotel"
                         class="property-image">
                @endif

                <div class="property-info">
                    <h3>{{ $booking->property->name }}</h3>
                    <div class="property-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $booking->property->city }}, {{ $booking->property->area }}
                    </div>
                    <div class="property-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        <span style="color: var(--text); margin-left: 6px; font-weight: 600;">
                            {{ number_format($booking->property->bintang ?? 4.5, 1) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Details -->
        <div class="card">
            <h2 class="card-title">
                <i class="fas fa-file-invoice"></i>
                Detail Pemesanan
            </h2>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-bed"></i>
                    Tipe Kamar
                </div>
                <div class="detail-value">{{ $booking->kamar->tipeKamar->nama_tipe }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-door-open"></i>
                    Nomor Kamar
                </div>
                <div class="detail-value">{{ $booking->kamar->nomor_kamar }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-calendar-check"></i>
                    Check-in
                </div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($booking->checkin_date)->isoFormat('dddd, D MMMM Y') }}
                    <span style="color: var(--text-light); font-size: 14px; margin-left: 8px;">14:00 WIB</span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-calendar-times"></i>
                    Check-out
                </div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($booking->checkout_date)->isoFormat('dddd, D MMMM Y') }}
                    <span style="color: var(--text-light); font-size: 14px; margin-left: 8px;">12:00 WIB</span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-moon"></i>
                    Jumlah Malam
                </div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays($booking->checkout_date) }} malam
                </div>
            </div>

            <div class="total-row detail-row">
                <div class="total-label">Total Pembayaran</div>
                <div class="total-value">Rp {{ number_format($booking->payment->price, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Guest Information -->
        <div class="card">
            <h2 class="card-title">
                <i class="fas fa-user"></i>
                Informasi Tamu
            </h2>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-user-circle"></i>
                    Nama Lengkap
                </div>
                <div class="detail-value">{{ $booking->user->name }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-envelope"></i>
                    Email
                </div>
                <div class="detail-value">{{ $booking->user->email }}</div>
            </div>

            @if($booking->user->phone)
            <div class="detail-row">
                <div class="detail-label">
                    <i class="fas fa-phone"></i>
                    Telepon
                </div>
                <div class="detail-value">{{ $booking->user->phone }}</div>
            </div>
            @endif
        </div>

        <!-- Payment Alert -->
        <div class="alert alert-info">
            <i class="fas fa-exclamation-circle"></i>
            <div class="alert-content">
                <h4>Selesaikan Pembayaran</h4>
                <p>Silakan lakukan pembayaran sebelum <strong>{{ \Carbon\Carbon::now()->addHours(24)->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</strong> untuk mengkonfirmasi booking Anda.</p>
                <p style="margin-top: 8px;">Konfirmasi pembayaran akan dikirim ke email Anda.</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="#" class="btn btn-primary">
                <i class="fas fa-credit-card"></i>
                Bayar Sekarang
            </a>

            <a href="{{ route('homepage') }}" class="btn btn-outline">
                <i class="fas fa-home"></i>
                Kembali ke Beranda
            </a>

            @auth
            <a href="{{ route('booking.index') }}" class="btn btn-outline">
                <i class="fas fa-list"></i>
                Lihat Semua Booking
            </a>
            @endauth
        </div>

        <!-- Contact Card -->
        <div class="contact-card" style="margin-top: 40px;">
            <h3>
                <i class="fas fa-question-circle" style="color: var(--accent); margin-right: 8px;"></i>
                Butuh Bantuan?
            </h3>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@luxuryallure.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+62 21 1234 5678</span>
                </div>
                <div class="contact-item">
                    <i class="fab fa-whatsapp"></i>
                    <span>+62 812 3456 7890</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Print booking confirmation
        function printConfirmation() {
            window.print();
        }

        // Copy booking code
        function copyBookingCode() {
            const code = document.querySelector('.booking-code').textContent;
            navigator.clipboard.writeText(code).then(() => {
                alert('Kode booking berhasil disalin!');
            });
        }
    </script>
</body>
</html>
