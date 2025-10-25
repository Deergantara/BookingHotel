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
            --radius: 8px;
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
        }/* ===== HEADER ===== */
        header {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid #333;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .logo-icon {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo i {
            font-size: 18px;
            color: var(--primary);
        }

        .logo h1 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            color: var(--accent);
            font-family: 'Playfair Display', serif;
            white-space: nowrap;
        }

        .header-search-form {
            flex: 1;
            max-width: 800px;
        }

        .search-form-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            align-items: end;
        }

        .search-form-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .search-form-item label {
            font-size: 12px;
            color: #ccc;
            font-weight: 500;
            white-space: nowrap;
        }

        .search-form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #444;
            border-radius: 6px;
            font-size: 14px;
            background: var(--primary-light);
            color: white;
            transition: all 0.3s ease;
        }

        .search-form-input:focus {
            border-color: var(--accent);
            outline: none;
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }

        .search-action {
            display: flex;
            align-items: end;
            height: 100%;
        }

        .search-btn {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            width: 100%;
            justify-content: center;
            height: 41px;
        }

        .search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

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

        .details-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
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

        .booking-form-container {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 100px;
            border: 1px solid var(--border);
        }

        .booking-form h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--primary);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .booking-form h3 i {
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

        .search-summary-value {
            padding: 12px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 6px;
            border: 1px solid var(--border);
            font-weight: 500;
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

        .book-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(212, 175, 55, 0.3);
        }

        .book-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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

        .status-tersedia {
            color: #16a34a;
            font-weight: 600;
        }

        .status-dipesan {
            color: #d97706;
            font-weight: 600;
        }

        .status-ditempati {
            color: #dc2626;
            font-weight: 600;
        }

        .status-perbaikan {
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

        @media (max-width: 992px) {
            .details-container {
                grid-template-columns: 1fr;
            }

            .booking-form-container {
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
    <header>
        <div class="header-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <h1>Luxury Allure</h1>
            </div>

        <div class="header-search-form">
                <form action="{{ route('property.search') }}" method="GET">
                    <div class="search-form-grid">
                        <div class="search-form-item">
                            <label>Check-in</label>
                            <input type="date" name="checkin" class="search-form-input "
                                   value="{{ $searchData['checkin'] ?? now()->format('Y-m-d') }}"
                                   id="headerCheckin">
                        </div>
                        <div class="search-form-item">
                            <label>Check-out</label>
                            <input type="date" name="checkout" class="search-form-input"
                                   value="{{ $searchData['checkout'] ?? now()->addDay()->format('Y-m-d') }}"
                                   id="headerCheckout">
                        </div>
                        <div class="search-form-item">
                            <label>Jumlah Tamu</label>
                            <select name="guests" class="search-form-input" id="headerTamu">
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ ($searchData['guests'] ?? 2) == $i ? 'selected' : '' }}>
                                        {{ $i }} Tamu
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="search-form-item">
                            <label>Jumlah Kamar</label>
                            <select name="rooms" class="search-form-input" id="headerKamar">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ ($searchData['rooms'] ?? 1) == $i ? 'selected' : '' }}>
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
        </div>
    </header>

    <div class="main-container">
        <!-- PHOTO GALLERY -->
        <div class="photo-section">
            @php
                $photos = [];
                if ($property->foto) {
                    if (is_string($property->foto)) {
                        $decoded = json_decode($property->foto, true);
                        if ($decoded && is_array($decoded)) {
                            $photos = $decoded;
                        }
                    } elseif (is_array($property->foto)) {
                        $photos = $property->foto;
                    }
                }
                $photos = array_filter($photos);
                $mainPhoto = count($photos) > 0 ? $photos[0] : null;
            @endphp

            @if($mainPhoto)
                <img src="{{ asset('storage/' . $mainPhoto) }}" 
                     alt="{{ $property->name }}" 
                     class="main-photo" 
                     id="mainPhoto"
                     onerror="this.src='https://via.placeholder.com/800x400?text=Hotel+Image'">
            @else
                <img src="https://via.placeholder.com/800x400?text=No+Image" 
                     alt="No Image" 
                     class="main-photo" 
                     id="mainPhoto">
            @endif

            <div class="photo-thumbnails">
                @if(count($photos) > 0)
                    @foreach(array_slice($photos, 0, 4) as $index => $foto)
                        <img src="{{ asset('storage/' . $foto) }}" 
                             alt="Thumbnail {{ $index + 1 }}"
                             class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                             data-full="{{ asset('storage/' . $foto) }}"
                             onerror="this.src='https://via.placeholder.com/120x80?text=Image'">
                    @endforeach
                @else
                    @for($i = 0; $i < 4; $i++)
                        <img src="https://via.placeholder.com/120x80?text=Image+{{ $i+1 }}" 
                             alt="Placeholder {{ $i+1 }}"
                             class="thumbnail {{ $i === 0 ? 'active' : '' }}"
                             data-full="https://via.placeholder.com/800x400?text=Image+{{ $i+1 }}">
                    @endfor
                @endif
            </div>
        </div>

        <div class="details-container">
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
                                $hasHalfStar = ($rating - $fullStars) >= 0.5;
                            @endphp

                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $fullStars)
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
                            <p>{{ $property->area ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Kontak</h4>
                            <p>{{ $property->contact ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Jumlah Kamar</h4>
                            <p>{{ $property->jumlah_kamar ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="detail-text">
                            <h4>Kapasitas Tamu</h4>
                            <p>{{ $property->kapasitas_tamu ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="price-tag">
                    <div class="price-label">Harga mulai dari</div>
                    <div class="price-amount">Rp {{ number_format($minPrice ?? 200000, 0, ',', '.') }}</div>
                    <div class="price-note">per malam</div>
                </div>

                <div class="facilities-section">
                    <h3 class="section-title"><i class="fas fa-concierge-bell"></i> Fasilitas</h3>
                    <div class="facilities-grid">
                        @php
                            $fasilitas = [];
                            if ($property->fasilitas) {
                                if (is_string($property->fasilitas)) {
                                    $decoded = json_decode($property->fasilitas, true);
                                    if ($decoded) {
                                        $fasilitas = $decoded;
                                    } else {
                                        $fasilitas = explode(',', $property->fasilitas);
                                    }
                                } elseif (is_array($property->fasilitas)) {
                                    $fasilitas = $property->fasilitas;
                                }
                            }
                            $fasilitas = array_map('trim', $fasilitas);
                            $fasilitas = array_filter($fasilitas);
                        @endphp

                        @if(count($fasilitas) > 0)
                            @foreach($fasilitas as $facility)
                                <div class="facility-item">
                                    <i class="fas fa-check"></i>
                                    <span>{{ $facility }}</span>
                                </div>
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

            <div class="booking-form-container">
                <form id="bookingForm" class="booking-form" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                    <input type="hidden" name="tipe_kamar_id" id="selectedTipeKamarId">
                    <input type="hidden" name="checkin" value="{{ $searchData['checkin'] ?? now()->format('Y-m-d') }}">
                    <input type="hidden" name="checkout" value="{{ $searchData['checkout'] ?? now()->addDay()->format('Y-m-d') }}">
                    <input type="hidden" name="guests" value="{{ $searchData['guests'] ?? 2 }}">
                    <input type="hidden" name="rooms" value="{{ $searchData['rooms'] ?? 1 }}">

                    <h3><i class="fas fa-calendar-check"></i> Form Pemesanan</h3>

                    <div class="form-group">
                        <label>Check-in:</label>
                        <div class="search-summary-value">
                            {{ \Carbon\Carbon::parse($searchData['checkin'] ?? now())->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Check-out:</label>
                        <div class="search-summary-value">
                            {{ \Carbon\Carbon::parse($searchData['checkout'] ?? now()->addDay())->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Tamu & Kamar:</label>
                        <div class="search-summary-value">
                            {{ $searchData['guests'] ?? 2 }} Tamu, {{ $searchData['rooms'] ?? 1 }} Kamar
                        </div>
                    </div>

                    <div id="selectedRoomInfo" style="text-align: center; margin-bottom: 15px; padding: 12px; background: rgba(212, 175, 55, 0.05); border-radius: 6px; display: none;">
                        <strong>Kamar Dipilih:</strong>
                        <div id="roomNameDisplay" style="font-size: 18px; color: var(--primary); margin-top: 5px;"></div>
                        <div id="roomPriceDisplay" style="font-size: 14px; color: var(--text-light);"></div>
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
                @forelse($property->tipeKamars as $tipe)
                    <div class="room-card">
                        <div class="room-badge">POPULER</div>

                        <div class="room-photo">
                            @php
                                $roomPhoto = null;
                                if ($tipe->foto) {
                                    if (is_string($tipe->foto)) {
                                        $roomPhoto = $tipe->foto;
                                    } elseif (is_array($tipe->foto)) {
                                        $roomPhoto = $tipe->foto[0] ?? null;
                                    }
                                }
                            @endphp

                            @if($roomPhoto)
                                <img src="{{ asset('storage/' . $roomPhoto) }}"
                                     alt="{{ $tipe->nama_tipe }}" 
                                     class="room-image"
                                     onerror="this.src='https://via.placeholder.com/400x200?text=Room+Image'">
                            @else
                                <img src="https://via.placeholder.com/400x200?text=Room+Image" 
                                     alt="Default Room"
                                     class="room-image">
                            @endif
                        </div>

                        <div class="room-content">
                            <div class="room-header">
                                <h4 class="room-title">{{ $tipe->nama_tipe }}</h4>
                                <div class="room-price">Rp {{ number_format($tipe->harga, 0, ',', '.') }}</div>
                            </div>

                            <p class="room-facilities">
                                @php
                                    $fasilitasKamar = [];
                                    if ($tipe->fasilitas_kamar) {
                                        if (is_string($tipe->fasilitas_kamar)) {
                                            $decoded = json_decode($tipe->fasilitas_kamar, true);
                                            if ($decoded) {
                                                $fasilitasKamar = $decoded;
                                            } else {
                                                $fasilitasKamar = explode(',', $tipe->fasilitas_kamar);
                                            }
                                        } elseif (is_array($tipe->fasilitas_kamar)) {
                                            $fasilitasKamar = $tipe->fasilitas_kamar;
                                        }
                                    }
                                    $fasilitasKamar = array_map('trim', $fasilitasKamar);
                                    $fasilitasKamar = array_filter($fasilitasKamar);
                                @endphp

                                @if(count($fasilitasKamar) > 0)
                                    {{ implode(' • ', array_slice($fasilitasKamar, 0, 3)) }}
                                    @if(count($fasilitasKamar) > 3)
                                        <span style="color: var(--accent);">+{{ count($fasilitasKamar) - 3 }} lainnya</span>
                                    @endif
                                @else
                                    {{ $tipe->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap' }}
                                @endif
                            </p>

                            @if($tipe->kamars && $tipe->kamars->count() > 0)
                                <div class="room-status">
                                    <p><strong>Status Kamar:</strong></p>
                                    @foreach($tipe->kamars->take(3) as $kamar)
                                        <div class="status-item">
                                            <span>Kamar {{ $kamar->nomor_kamar }}</span>
                                            <span class="status-{{ $kamar->status }}">
                                                {{ ucfirst($kamar->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                    @if($tipe->kamars->count() > 3)
                                        <div style="text-align: center; margin-top: 8px; color: var(--text-light); font-size: 12px;">
                                            +{{ $tipe->kamars->count() - 3 }} kamar lainnya
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div style="padding: 12px; background: rgba(220, 38, 38, 0.05); border-radius: 6px; margin: 16px 0;">
                                    <p style="color: #dc2626; font-size: 14px; text-align: center;">
                                        <i class="fas fa-exclamation-circle"></i> Tidak ada kamar tersedia
                                    </p>
                                </div>
                            @endif

                            <button type="button" 
                                    class="room-book-btn pilih-kamar-btn"
                                    data-id="{{ $tipe->id }}" 
                                    data-name="{{ $tipe->nama_tipe }}"
                                    data-harga="{{ $tipe->harga }}"
                                    data-harga-format="{{ number_format($tipe->harga, 0, ',', '.') }}">
                                <i class="fas fa-calendar-plus"></i> Pilih Kamar Ini
                            </button>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; grid-column: 1/-1;">
                        <i class="fas fa-bed" style="font-size: 48px; color: var(--border); margin-bottom: 16px;"></i>
                        <p style="color: var(--text-light);">Tidak ada tipe kamar yang tersedia untuk properti ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headerCheckin = document.getElementById('headerCheckin');
            const headerCheckout = document.getElementById('headerCheckout');
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainPhoto = document.getElementById('mainPhoto');
            const pilihKamarBtns = document.querySelectorAll('.pilih-kamar-btn');
            const selectedRoomInfo = document.getElementById('selectedRoomInfo');
            const roomNameDisplay = document.getElementById('roomNameDisplay');
            const roomPriceDisplay = document.getElementById('roomPriceDisplay');
            const selectedTipeKamarId = document.getElementById('selectedTipeKamarId');
            const pesanBtn = document.getElementById('pesanBtn');

            // Set minimal tanggal untuk checkin (hari ini)
            const today = new Date().toISOString().split('T')[0];
            headerCheckin.min = today;

            // Atur tanggal checkout minimal sama dengan checkin
            headerCheckin.addEventListener('change', function() {
                const checkinDate = new Date(this.value);
                checkinDate.setDate(checkinDate.getDate() + 1);
                const minCheckout = checkinDate.toISOString().split('T')[0];
                headerCheckout.min = minCheckout;
                
                if (headerCheckout.value && headerCheckout.value <= this.value) {
                    headerCheckout.value = minCheckout;
                }
            });

            // Initialize checkout min date
            if (headerCheckin.value) {
                const checkinDate = new Date(headerCheckin.value);
                checkinDate.setDate(checkinDate.getDate() + 1);
                headerCheckout.min = checkinDate.toISOString().split('T')[0];
            } else {
                headerCheckout.min = today;
            }

            // Thumbnail handler
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    const fullImageSrc = this.getAttribute('data-full');
                    mainPhoto.src = fullImageSrc;
                });
            });

            // Pilih kamar handler
            pilihKamarBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const nama = this.dataset.name;
                    const harga = this.dataset.harga;
                    const hargaFormat = this.dataset.hargaFormat;
                    const id = this.dataset.id;

                    // Update tampilan form booking
                    roomNameDisplay.textContent = nama;
                    roomPriceDisplay.textContent = 'Harga: Rp ' + hargaFormat + ' / malam';
                    selectedRoomInfo.style.display = 'block';

                    selectedTipeKamarId.value = id;
                    pesanBtn.disabled = false;

                    // Highlight button yang dipilih
                    pilihKamarBtns.forEach(b => {
                        b.style.opacity = '1';
                        b.innerHTML = '<i class="fas fa-calendar-plus"></i> Pilih Kamar Ini';
                    });
                    this.style.opacity = '0.8';
                    this.innerHTML = '<i class="fas fa-check"></i> Dipilih';

                    // Scroll ke form booking (mobile)
                    if (window.innerWidth < 992) {
                        document.querySelector('.booking-form-container').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Form validation
            const bookingForm = document.getElementById('bookingForm');
            bookingForm.addEventListener('submit', function(e) {
                if (!selectedTipeKamarId.value) {
                    e.preventDefault();
                    alert('Silakan pilih tipe kamar terlebih dahulu!');
                }
            });
        });
    </script>

</body>
</html>