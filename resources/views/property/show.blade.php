<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->name }} - Luxury Allure</title>
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background-color: #f8fafc;
        }

        /* ===== HEADER ===== */
        header {
            background: var(--primary);
            color: white;
            padding: 16px 40px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #333;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
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

        /* ===== HEADER SEARCH FORM ===== */
        .header-search-form {
            background: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .search-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            align-items: end;
        }

        .search-form-item {
            margin-bottom: 0;
        }

        .search-form-item label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--text);
            font-size: 14px;
        }

        .search-form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: white;
            color: var(--text);
        }

        .search-form-input:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .search-action {
            display: flex;
            align-items: end;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }

        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        /* ===== MAIN CONTENT ===== */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        /* ===== PHOTO GALLERY ===== */
        .photo-section {
            margin-bottom: 40px;
        }

        .main-photo {
            width: 100%;
            height: 400px;
            border-radius: var(--radius);
            object-fit: cover;
            box-shadow: var(--shadow);
            margin-bottom: 16px;
            border: 1px solid var(--border);
        }

        .photo-thumbnails {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .thumbnail {
            width: 100%;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            transform: scale(1.05);
            border-color: var(--accent);
        }

        .thumbnail.active {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.3);
        }

        /* ===== PROPERTY DETAILS ===== */
        .details-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        @media (max-width: 768px) {
            .details-container {
                grid-template-columns: 1fr;
            }
        }

        .property-info {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .property-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 2px solid var(--accent);
            padding-bottom: 20px;
        }

        .property-title h2 {
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 8px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .property-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 16px;
        }

        .property-location i {
            color: var(--accent);
        }

        .property-rating {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .rating-stars {
            color: var(--accent);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .rating-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            background: rgba(212, 175, 55, 0.1);
            padding: 6px 12px;
            border-radius: 6px;
        }

        .property-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateY(-2px);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .detail-text h4 {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .detail-text p {
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
        }

        .price-tag {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            padding: 24px;
            border-radius: var(--radius);
            text-align: center;
            margin: 24px 0;
            box-shadow: var(--shadow);
        }

        .price-label {
            font-size: 16px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .price-amount {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .price-note {
            font-size: 14px;
            font-weight: 500;
        }

        /* ===== FACILITIES ===== */
        .facilities-section {
            margin: 24px 0;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 16px;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
        }

        .section-title i {
            color: var(--accent);
        }

        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
        }

        .facility-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .facility-item:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateX(5px);
        }

        .facility-item i {
            color: var(--accent);
            width: 20px;
        }

        /* ===== BOOKING FORM ===== */
        .Booking-form-container {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 100px;
            border: 1px solid var(--border);
        }

        .Booking-form h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .Booking-form h3 i {
            color: var(--accent);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .date-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .book-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(212, 175, 55, 0.3);
        }

        .policies-box {
            background: rgba(212, 175, 55, 0.05);
            border-left: 4px solid var(--accent);
            padding: 16px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .policies-box h4 {
            margin-bottom: 8px;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        /* ===== ROOM TYPES ===== */
        .room-section {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
            border: 1px solid var(--border);
        }

        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            margin-top: 20px;
        }

        .room-card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
            position: relative;
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
            border-color: var(--accent);
        }

        .room-badge {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            z-index: 2;
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .room-card:hover .room-image {
            transform: scale(1.05);
        }

        .room-content {
            padding: 20px;
        }

        .room-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .room-title {
            font-size: 20px;
            color: var(--primary);
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }

        .room-price {
            font-size: 22px;
            font-weight: 800;
            color: var(--accent);
        }

        .room-facilities {
            margin: 16px 0;
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.5;
        }

        .room-status {
            margin: 16px 0;
        }

        .status-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .status-available {
            color: #16a34a;
            font-weight: 600;
        }

        .status-booked {
            color: #d97706;
            font-weight: 600;
        }

        .status-occupied {
            color: #dc2626;
            font-weight: 600;
        }

        .status-maintenance {
            color: #6b7280;
            font-weight: 600;
        }

        .room-book-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .room-book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 992px) {
            .details-container {
                grid-template-columns: 1fr;
            }

            .Booking-form-container {
                position: static;
            }
        }

        @media (max-width: 768px) {
            header {
                padding: 16px 20px;
            }

            .header-top {
                flex-direction: column;
                gap: 16px;
                margin-bottom: 15px;
            }

            .search-form-grid {
                grid-template-columns: 1fr;
            }

            .property-header {
                flex-direction: column;
                gap: 16px;
            }

            .property-rating {
                align-items: flex-start;
            }

            .room-grid {
                grid-template-columns: 1fr;
            }

            .date-inputs {
                grid-template-columns: 1fr;
            }
        }

        /* ===== UTILITY CLASSES ===== */
        .text-center {
            text-align: center;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        @media (max-width: 640px) {
            .photo-thumbnails {
                grid-template-columns: repeat(3, 1fr);
            }

            .facilities-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER WITH INTEGRATED SEARCH -->
    <header>
        <div class="header-top">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h1>Luxury Allure</h1>
            </div>
        </div>

        <!-- INTEGRATED SEARCH FORM -->
        <div class="header-search-form">
            <form id="headerSearchForm" action="{{ route('property.search') }}" method="GET">
                <div class="search-form-grid">
                    <div class="search-form-item">
                        <label>Check-in</label>
                        <input type="date" name="checkin" class="search-form-input"
                               value="{{ request('checkin', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                               id="headerCheckin">
                    </div>
                    <div class="search-form-item">
                        <label>Check-out</label>
                        <input type="date" name="checkout" class="search-form-input"
                               value="{{ request('checkout', \Carbon\Carbon::now()->addDays(1)->format('Y-m-d')) }}"
                               id="headerCheckout">
                    </div>
                    <div class="search-form-item">
                        <label>Jumlah Tamu</label>
                        <select name="tamu" class="search-form-input" id="headerTamu">
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ request('tamu', '1') == $i ? 'selected' : '' }}>
                                    {{ $i }} Tamu
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="search-form-item">
                        <label>Jumlah Kamar</label>
                        <select name="kamar" class="search-form-input" id="headerKamar">
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('kamar', '1') == $i ? 'selected' : '' }}>
                                    {{ $i }} Kamar
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="search-action">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main-container">
        <!-- PHOTO GALLERY -->
        <div class="photo-section">
            @php
                $image = is_array($property->foto) ? $property->foto[0] : $property->foto;
                $imagePath = public_path('images/' . $image);
            @endphp

            @if ($image && file_exists($imagePath))
                <img src="{{ asset('images/' . $image) }}" alt="{{ $property->name }}" class="main-photo"
                    id="mainPhoto">
            @else
                <img src="{{ asset('images/default-hotel.jpg') }}" alt="Hotel Default" class="main-photo"
                    id="mainPhoto">
            @endif

            <div class="photo-thumbnails">
                @if (is_array($property->foto))
                    @foreach ($property->foto as $index => $foto)
                        <img src="{{ asset('images/' . $foto) }}" alt="Thumbnail {{ $index + 1 }}"
                            class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                            data-full="{{ asset('images/' . $foto) }}">
                    @endforeach
                @else
                    <img src="{{ asset('images/' . $property->foto) }}" alt="Thumbnail" class="thumbnail active"
                        data-full="{{ asset('images/' . $property->foto) }}">
                @endif

                <!-- Fallback thumbnails -->
                @for ($i = 0; $i < 3; $i++)
                    <img src="{{ asset('images/default-hotel.jpg') }}" alt="Thumbnail {{ $i + 2 }}"
                        class="thumbnail" data-full="{{ asset('images/default-hotel.jpg') }}">
                @endfor
            </div>
        </div>

        <!-- PROPERTY DETAILS AND BOOKING FORM -->
        <div class="details-container">
            <!-- PROPERTY INFO -->
            <div class="property-info">
                <div class="property-header">
                    <div class="property-title">
                        <h2>{{ $property->name }}</h2>
                        <div class="property-location">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $property->address }}, {{ $property->city }}</span>
                        </div>
                    </div>
                    <div class="property-rating">
                        <div class="rating-stars">
                            @php
                                $rating = $property->bintang ?? 4.5;
                                $fullStars = floor($rating);
                                $hasHalfStar = $rating - $fullStars >= 0.5;
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullStars)
                                    <i class="fas fa-star"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <div class="rating-value">{{ number_format($rating, 1) }}/5</div>
                    </div>
                </div>

                <div class="property-details-grid">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Area</h4>
                            <p>{{ $property->area }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Kontak</h4>
                            <p>{{ $property->contact }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Jumlah Kamar</h4>
                            <p>{{ $property->jumlah_kamar }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Kapasitas Tamu</h4>
                            <p>{{ $property->kapasitas_tamu }}</p>
                        </div>
                    </div>
                </div>

                <div class="price-tag">
                    <div class="price-label">Harga mulai dari</div>
                    <div class="price-amount">Rp {{ number_format($property->harga ?? 200000, 0, ',', '.') }}</div>
                    <div class="price-note">per malam</div>
                </div>

                <!-- FACILITIES -->
                <div class="facilities-section">
                    <h3 class="section-title"><i class="fas fa-concierge-bell"></i> Fasilitas</h3>
                    <div class="facilities-grid">
                        @if ($property->fasilitas)
                            @foreach (explode(',', $property->fasilitas) as $facility)
                                @if (trim($facility) !== '')
                                    <div class="facility-item">
                                        <i class="fas fa-check"></i>
                                        <span>{{ trim($facility) }}</span>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="facility-item">
                                <i class="fas fa-info-circle"></i>
                                <span>Fasilitas belum tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- BOOKING FORM -->
            <div class="Booking-form-container">
                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tipe_kamar_id" id="selectedTipeKamarId">
                    <input type="hidden" name="checkin_date" id="hiddenCheckin" value="{{ request('checkin', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                    <input type="hidden" name="checkout_date" id="hiddenCheckout" value="{{ request('checkout', \Carbon\Carbon::now()->addDays(1)->format('Y-m-d')) }}">
                    <input type="hidden" name="jumlah_tamu" id="hiddenTamu" value="{{ request('tamu', '1') }}">
                    <input type="hidden" name="jumlah_kamar" id="hiddenKamar" value="{{ request('kamar', '1') }}">

                    <h3><i class="fas fa-calendar-check"></i> Form Pemesanan</h3>

                    <div class="form-group">
                        <label>Check-in:</label>
                        <div class="search-summary-value">
                            {{ \Carbon\Carbon::parse(request('checkin', \Carbon\Carbon::now()->format('Y-m-d')))->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Check-out:</label>
                        <div class="search-summary-value">
                            {{ \Carbon\Carbon::parse(request('checkout', \Carbon\Carbon::now()->addDays(1)->format('Y-m-d')))->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Tamu & Kamar:</label>
                        <div class="search-summary-value">
                            {{ request('tamu', '1') }} Tamu, {{ request('kamar', '1') }} Kamar
                        </div>
                    </div>

                    <div id="selectedRoomInfo" class="text-center mb-3 text-gray-700">
                        <em>Belum ada kamar yang dipilih.</em>
                    </div>

                    <button type="submit" id="pesanBtn" class="book-btn" disabled>
                        <i class="fas fa-check-circle"></i> Pesan Sekarang
                    </button>
                </form>

                <div class="policies-box">
                    <h4><i class="fas fa-info-circle"></i> Kebijakan</h4>
                    <p>Check-in: 14:00 WIB | Check-out: 12:00 WIB</p>
                    <p>Pembatalan gratis hingga 24 jam sebelum check-in</p>
                </div>
            </div>
        </div>

        <!-- ROOM TYPES -->
        <div class="room-section">
            <h3 class="section-title"><i class="fas fa-bed"></i> Pilihan Tipe Kamar di {{ $property->name }}</h3>

            <div class="room-grid">
                @forelse($tipeKamars as $tipe)
                    <div class="room-card">
                        <div class="room-badge">POPULER</div>

                        <!-- ROOM IMAGE -->
                        <div class="room-photo">
                            @php
                                $fotoPath = public_path('images/tipe_kamar/' . $tipe->foto);
                            @endphp

                            @if ($tipe->foto && file_exists($fotoPath))
                                <img src="{{ asset('images/tipe_kamar/' . $tipe->foto) }}"
                                    alt="{{ $tipe->name }}" class="room-image">
                            @else
                                <img src="{{ asset('images/default-room.jpg') }}" alt="Default Room"
                                    class="room-image">
                            @endif
                        </div>

                        <!-- ROOM INFO -->
                        <div class="room-content">
                            <div class="room-header">
                                <h4 class="room-title">{{ $tipe->name }}</h4>
                                <div class="room-price">Rp {{ number_format($tipe->harga, 0, ',', '.') }}</div>
                            </div>

                            <p class="room-facilities">{{ $tipe->fasilitas_kamar ?? 'Fasilitas belum tersedia.' }}
                            </p>

                            @if ($tipe->kamars->count() > 0)
                                <div class="room-status">
                                    <p><strong>Status Kamar:</strong></p>
                                    @foreach ($tipe->kamars as $kamar)
                                        <div class="status-item">
                                            <span>Kamar {{ $kamar->nomor_kamar }}</span>
                                            <span class="status-{{ $kamar->status }}">
                                                {{ ucfirst($kamar->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p><em>Tidak ada kamar untuk tipe ini.</em></p>
                            @endif

                            <!-- BOOKING BUTTON -->
                            <button type="button" class="room-book-btn pilih-kamar-btn"
                                data-id="{{ $tipe->id }}" data-name="{{ $tipe->name }}"
                                data-harga="{{ number_format($tipe->harga, 0, ',', '.') }}">
                                <i class="fas fa-calendar-plus"></i> Pilih Kamar Ini
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center mb-20">
                        <p>Tidak ada tipe kamar yang tersedia untuk properti ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerCheckin = document.getElementById('headerCheckin');
            const headerCheckout = document.getElementById('headerCheckout');
            const headerTamu = document.getElementById('headerTamu');
            const headerKamar = document.getElementById('headerKamar');
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainPhoto = document.getElementById('mainPhoto');
            const pilihKamarBtns = document.querySelectorAll('.pilih-kamar-btn');
            const selectedRoomInfo = document.getElementById('selectedRoomInfo');
            const selectedTipeKamarId = document.getElementById('selectedTipeKamarId');
            const pesanBtn = document.getElementById('pesanBtn');

            // Set minimal tanggal untuk checkin (hari ini)
            const today = new Date().toISOString().split('T')[0];
            headerCheckin.min = today;

            // Atur tanggal checkout minimal sama dengan checkin
            headerCheckin.addEventListener('change', function() {
                headerCheckout.min = this.value;
                if (headerCheckout.value && headerCheckout.value < this.value) {
                    headerCheckout.value = this.value;
                }
            });

            // Initialize checkout min date
            headerCheckout.min = headerCheckin.value;

            // Thumbnail handler
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    mainPhoto.src = this.getAttribute('data-full');
                });
            });

            // Pilih kamar handler
            pilihKamarBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const nama = this.dataset.name;
                    const harga = this.dataset.harga;
                    const id = this.dataset.id;

                    // Update tampilan form booking
                    selectedRoomInfo.innerHTML = `
                        <strong>Kamar Dipilih:</strong> ${nama}<br>
                        <span class="text-sm text-gray-500">Harga: Rp ${harga} / malam</span>
                    `;

                    selectedTipeKamarId.value = id;
                    pesanBtn.disabled = false;

                    // Scroll ke form booking
                    document.querySelector('.Booking-form-container').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>

</body>

</html>
