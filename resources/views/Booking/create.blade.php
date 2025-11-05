<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - {{ $property->name }} - Luxury Allure</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
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

        /* ===== HEADER ===== */
        .header {
            background: var(--primary);
            color: white;
            padding: 16px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            border-bottom: 1px solid #333;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo i {
            font-size: 20px;
            color: var(--primary);
        }

        .logo h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: var(--accent);
            font-family: 'Playfair Display', serif;
        }

        /* ===== MAIN CONTAINER ===== */
        .main-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* ===== BOOKING CARD ===== */
        .booking-card {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .booking-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .booking-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
        }

        .property-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            font-family: 'Playfair Display', serif;
            color: var(--accent);
        }

        .property-location {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #d1d5db;
            font-size: 16px;
        }

        .property-location i {
            color: var(--accent);
        }

        /* ===== BOOKING FORM ===== */
        .booking-form {
            padding: 40px;
        }

        .form-section {
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--accent);
            width: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
            color: var(--text);
        }

        .form-control:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 12px center;
            background-repeat: no-repeat;
            background-size: 16px;
            padding-right: 40px;
        }

        .date-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            pointer-events: none;
        }

        /* ===== ROOM OPTIONS ===== */
        .room-options {
            display: grid;
            gap: 16px;
        }

        .room-option {
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            position: relative;
        }

        .room-option:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.15);
        }

        .room-option.selected {
            border-color: var(--accent);
            background: rgba(212, 175, 55, 0.05);
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .room-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            font-family: 'Playfair Display', serif;
        }

        .room-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--accent);
        }

        .room-facilities {
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .room-capacity {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 14px;
        }

        .room-capacity i {
            color: var(--accent);
        }

        .room-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .feature-tag {
            background: rgba(212, 175, 55, 0.1);
            color: var(--accent);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        /* ===== CUSTOM RADIO STYLING ===== */
        input[type="radio"] {
            display: none;
        }

        .room-option::before {
            content: '';
            position: absolute;
            top: 20px;
            right: 20px;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .room-option.selected::before {
            border-color: var(--accent);
            background: var(--accent);
        }

        .room-option.selected::after {
            content: '';
            position: absolute;
            top: 25px;
            right: 25px;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
        }

        /* ===== PRICE SUMMARY ===== */
        .price-summary {
            background: rgba(212, 175, 55, 0.05);
            border-radius: 10px;
            padding: 24px;
            margin-top: 24px;
            border-left: 4px solid var(--accent);
        }

        .price-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .price-title i {
            color: var(--accent);
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        .price-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 18px;
            color: var(--accent);
            margin-top: 8px;
            padding-top: 12px;
            border-top: 2px solid rgba(212, 175, 55, 0.3);
        }

        .price-label {
            color: var(--text-light);
            font-size: 14px;
        }

        .price-value {
            font-weight: 600;
            color: var(--text);
        }

        /* ===== SUBMIT BUTTON ===== */
        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            border: none;
            padding: 16px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* ===== BREADCRUMB ===== */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: var(--text-light);
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb a:hover {
            color: var(--primary);
        }

        .breadcrumb-separator {
            color: var(--border);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .main-container {
                margin: 20px auto;
                padding: 0 16px;
            }

            .booking-form {
                padding: 24px;
            }

            .date-inputs {
                grid-template-columns: 1fr;
            }

            .room-header {
                flex-direction: column;
                gap: 8px;
            }

            .property-name {
                font-size: 24px;
            }

            .room-option::before {
                top: 15px;
                right: 15px;
            }

            .room-option.selected::after {
                top: 20px;
                right: 20px;
            }
        }

        @media (max-width: 480px) {
            .booking-header {
                padding: 20px;
            }

            .booking-form {
                padding: 20px;
            }

            .form-section {
                margin-bottom: 24px;
                padding-bottom: 20px;
            }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .booking-card {
            animation: fadeIn 0.6s ease-out;
        }

        .room-option {
            animation: fadeIn 0.4s ease-out;
        }

        /* ===== LOADING STATES ===== */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .submit-btn.loading {
            position: relative;
            color: transparent;
        }

        .submit-btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top: 2px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-crown"></i>
            </div>
            <h1>Luxury Allure</h1>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('property.search') }}">Cari Hotel</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('property.show', $property->id) }}">{{ $property->name }}</a>
            <span class="breadcrumb-separator">/</span>
            <span>Booking</span>
        </div>

        <div class="booking-card">
            <!-- BOOKING HEADER -->
            <div class="booking-header">
                <h2 class="property-name">{{ $property->name }}</h2>
                <div class="property-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $property->address }}, {{ $property->city }}</span>
                </div>
            </div>

            <!-- BOOKING FORM -->
            <form action="{{ route('booking.store') }}" method="POST" class="booking-form" id="bookingForm">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <!-- ROOM TYPE SELECTION -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-bed"></i>
                        Pilih Tipe Kamar
                    </h3>
                    <div class="room-options" id="roomOptions">
                        @foreach($property->tipe_kamars as $tipe)
                            <label class="room-option">
                                <input type="radio" name="tipe_kamar_id" value="{{ $tipe->id }}" required
                                       data-price="{{ $tipe->harga }}"
                                       {{ $loop->first ? 'checked' : '' }}>
                                <div class="room-header">
                                    <div class="room-info">
                                        <div class="room-name">{{ $tipe->nama_tipe }}</div>
                                        <div class="room-facilities">{{ $tipe->fasilitas_kamar ?? 'Fasilitas standar' }}</div>
                                        <div class="room-capacity">
                                            <i class="fas fa-users"></i>
                                            <span>Maksimal {{ $tipe->kapasitas ?? 2 }} tamu</span>
                                        </div>
                                        @if($tipe->fasilitas_kamar)
                                            <div class="room-features">
                                                @php
                                                    $features = is_array($tipe->fasilitas_kamar)
                                                        ? $tipe->fasilitas_kamar
                                                        : explode(',', $tipe->fasilitas_kamar);
                                                @endphp
                                                @foreach(array_slice($features, 0, 3) as $feature)
                                                    <span class="feature-tag">{{ trim($feature) }}</span>
                                                @endforeach
                                                @if(count($features) > 3)
                                                    <span class="feature-tag">+{{ count($features) - 3 }} lainnya</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="room-price">Rp {{ number_format($tipe->harga, 0, ',', '.') }}/malam</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Cari bagian ini di file Anda (sekitar baris 810) dan ganti dengan kode ini -->

@if(!$isLoggedIn)
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-user"></i>
        Informasi Pemesan
    </h3>

    <div class="form-group">
        <label class="form-label">Nama Lengkap <span style="color: red;">*</span></label>
        <div class="input-with-icon">
            <input type="text" name="guest_name" class="form-control" required
                   value="{{ old('guest_name') }}" placeholder="Masukkan nama lengkap Anda">
            <i class="fas fa-user input-icon"></i>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Email <span style="color: red;">*</span></label>
        <div class="input-with-icon">
            <input type="email" name="guest_email" class="form-control" required
                   value="{{ old('guest_email') }}" placeholder="contoh@email.com">
            <i class="fas fa-envelope input-icon"></i>
        </div>
        <small style="color: var(--text-light); font-size: 12px; margin-top: 4px; display: block;">
            Konfirmasi booking akan dikirim ke email ini
        </small>
    </div>

    <div class="form-group">
        <label class="form-label">Nomor Telepon <span style="color: red;">*</span></label>
        <div class="input-with-icon">
            <input type="tel" name="guest_phone" class="form-control" required
                   value="{{ old('guest_phone') }}" placeholder="08xxxxxxxxxx">
            <i class="fas fa-phone input-icon"></i>
        </div>
    </div>

    <!-- Optional: Create Account -->
    <div style="background: rgba(212, 175, 55, 0.05); padding: 16px; border-radius: 8px; margin-top: 16px;">
        <label style="display: flex; align-items: start; gap: 12px; cursor: pointer;">
            <input type="checkbox" name="create_account" value="1" id="createAccountCheckbox"
                   style="margin-top: 4px; width: 18px; height: 18px; cursor: pointer;">
            <div>
                <strong style="color: var(--primary); display: block; margin-bottom: 4px;">
                    Buat akun untuk booking lebih mudah
                </strong>
                <small style="color: var(--text-light); font-size: 13px;">
                    Dengan membuat akun, Anda dapat melacak pesanan dan mendapatkan penawaran khusus
                </small>
            </div>
        </label>

        <!-- Password fields (hidden by default) -->
        <div id="passwordFields" style="display: none; margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(212, 175, 55, 0.2);">
            <div class="form-group" style="margin-bottom: 12px;">
                <label class="form-label" style="font-size: 14px;">Password <span style="color: red;">*</span></label>
                <div class="input-with-icon">
                    <input type="password" name="guest_password" class="form-control"
                           placeholder="Minimal 8 karakter" minlength="8">
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label" style="font-size: 14px;">Konfirmasi Password <span style="color: red;">*</span></label>
                <div class="input-with-icon">
                    <input type="password" name="guest_password_confirmation" class="form-control"
                           placeholder="Ulangi password" minlength="8">
                    <i class="fas fa-lock input-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- LOGGED IN USER INFO -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-user-check"></i>
        Informasi Pemesan
    </h3>

    <div style="background: rgba(212, 175, 55, 0.05); padding: 20px; border-radius: 8px; border-left: 4px solid var(--accent);">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 24px; font-weight: 700;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight: 700; font-size: 18px; color: var(--primary);">
                    {{ $user->name }}
                </div>
                <div style="color: var(--text-light); font-size: 14px;">
                    <i class="fas fa-envelope" style="margin-right: 6px;"></i>
                    {{ $user->email }}
                </div>
                @if($user->phone)
                <div style="color: var(--text-light); font-size: 14px;">
                    <i class="fas fa-phone" style="margin-right: 6px;"></i>
                    {{ $user->phone }}
                </div>
                @endif
            </div>
        </div>
        <small style="color: var(--text-light); font-size: 12px;">
            <i class="fas fa-info-circle"></i>
            Konfirmasi booking akan dikirim ke email Anda
        </small>
    </div>
</div>
@endif

<!-- DATES & GUESTS -->
<div class="form-section">
    <h3 class="section-title">
        <i class="fas fa-calendar-alt"></i>
        Detail Pemesanan
    </h3>

    <div class="date-inputs">
        <div class="form-group">
            <label class="form-label">Check-in</label>
            <div class="input-with-icon">
                <input type="date" name="checkin_date" value="{{ $checkin }}"
                       class="form-control" required min="{{ date('Y-m-d') }}"
                       id="checkinDate">
                <i class="fas fa-calendar-day input-icon"></i>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Check-out</label>
            <div class="input-with-icon">
                <input type="date" name="checkout_date" value="{{ $checkout }}"
                       class="form-control" required id="checkoutDate">
                <i class="fas fa-calendar-day input-icon"></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="form-label">Jumlah Tamu</label>
        <div class="input-with-icon">
            <select name="guests" class="form-control form-select" required>
                @for($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}" {{ $totalGuests == $i ? 'selected' : '' }}>
                        {{ $i }} Tamu
                    </option>
                @endfor
            </select>
            <i class="fas fa-user-friends input-icon"></i>
        </div>
    </div>
</div>

                <!-- PRICE SUMMARY -->
                <div class="price-summary">
                    <div class="price-title">
                        <i class="fas fa-receipt"></i>
                        Ringkasan Biaya
                    </div>
                    <div class="price-row">
                        <span class="price-label">Harga per malam</span>
                        <span class="price-value" id="pricePerNight">Rp 0</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Jumlah malam</span>
                        <span class="price-value" id="nightsCount">0 malam</span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Total Pembayaran</span>
                        <span class="price-value" id="totalPrice">Rp 0</span>
                    </div>
                </div>

                <!-- SUBMIT BUTTON -->
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-lock"></i>
                    Lanjutkan ke Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomOptions = document.querySelectorAll('input[name="tipe_kamar_id"]');
            const checkinInput = document.getElementById('checkinDate');
            const checkoutInput = document.getElementById('checkoutDate');
            const pricePerNightEl = document.getElementById('pricePerNight');
            const nightsCountEl = document.getElementById('nightsCount');
            const totalPriceEl = document.getElementById('totalPrice');
            const bookingForm = document.getElementById('bookingForm');
            const submitBtn = document.getElementById('submitBtn');

            // Room selection styling
            roomOptions.forEach(option => {
                option.addEventListener('change', function() {
                    // Remove selected class from all options
                    document.querySelectorAll('.room-option').forEach(room => {
                        room.classList.remove('selected');
                    });

                    // Add selected class to current option
                    this.closest('.room-option').classList.add('selected');
                    updatePriceSummary();
                });

                // Initialize selected state
                if (option.checked) {
                    option.closest('.room-option').classList.add('selected');
                }
            });

            // Date validation and price calculation
            checkinInput.addEventListener('change', function() {
                const minCheckout = new Date(this.value);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.min = minCheckout.toISOString().split('T')[0];

                if (checkoutInput.value && checkoutInput.value < this.value) {
                    checkoutInput.value = '';
                }
                updatePriceSummary();
            });

            checkoutInput.addEventListener('change', updatePriceSummary);

            function updatePriceSummary() {
                const selectedRoom = document.querySelector('input[name="tipe_kamar_id"]:checked');
                const checkin = new Date(checkinInput.value);
                const checkout = new Date(checkoutInput.value);

                if (selectedRoom && checkinInput.value && checkoutInput.value && checkout > checkin) {
                    const pricePerNight = parseInt(selectedRoom.getAttribute('data-price'));
                    const nights = Math.ceil((checkout - checkin) / (1000 * 60 * 60 * 24));
                    const totalPrice = pricePerNight * nights;

                    pricePerNightEl.textContent = `Rp ${pricePerNight.toLocaleString('id-ID')}`;
                    nightsCountEl.textContent = `${nights} malam`;
                    totalPriceEl.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                } else {
                    pricePerNightEl.textContent = 'Rp 0';
                    nightsCountEl.textContent = '0 malam';
                    totalPriceEl.textContent = 'Rp 0';
                }
            }

            // Form submission
            bookingForm.addEventListener('submit', function(e) {
                const selectedRoom = document.querySelector('input[name="tipe_kamar_id"]:checked');
                if (!selectedRoom) {
                    e.preventDefault();
                    alert('Silakan pilih tipe kamar terlebih dahulu!');
                    return;
                }

                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            });

            // Initialize
            const today = new Date().toISOString().split('T')[0];
            checkinInput.min = today;

            if (checkoutInput.value) {
                const checkoutDate = new Date(checkoutInput.value);
                const minCheckout = new Date(checkinInput.value);
                minCheckout.setDate(minCheckout.getDate() + 1);
                checkoutInput.min = minCheckout.toISOString().split('T')[0];
            }

            updatePriceSummary();
        });

        // Toggle password fields ketika checkbox create account dicentang
document.addEventListener('DOMContentLoaded', function() {
    const createAccountCheckbox = document.getElementById('createAccountCheckbox');
    const passwordFields = document.getElementById('passwordFields');

    if (createAccountCheckbox) {
        createAccountCheckbox.addEventListener('change', function() {
            if (this.checked) {
                passwordFields.style.display = 'block';
                // Set required attribute
                passwordFields.querySelectorAll('input').forEach(input => {
                    input.required = true;
                });
            } else {
                passwordFields.style.display = 'none';
                // Remove required attribute
                passwordFields.querySelectorAll('input').forEach(input => {
                    input.required = false;
                    input.value = '';
                });
            }
        });
    }

    // Existing code untuk room selection, date validation, dll...
    // ... (kode yang sudah ada sebelumnya)
});
    </script>
</body>
</html>
