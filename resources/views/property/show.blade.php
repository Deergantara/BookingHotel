<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->name }} - Luxury Stay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --secondary: #f8f9fa;
            --accent: #ff6d00;
            --text: #202124;
            --text-light: #5f6368;
            --border: #dadce0;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: var(--text);
            background-color: #f8fafc;
        }

        /* ===== HEADER ===== */
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 16px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo i {
            font-size: 28px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        .search-form input {
            width: 300px;
            padding: 12px 16px;
            border: none;
            border-radius: 24px;
            outline: none;
            font-size: 15px;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .search-form input:focus {
            background: white;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }

        .search-form button {
            background: white;
            color: var(--primary);
            border: none;
            padding: 12px 20px;
            border-radius: 24px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .search-form button:hover {
            background: var(--secondary);
            transform: translateY(-2px);
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
            transition: transform 0.3s ease;
        }

        .thumbnail:hover {
            transform: scale(1.05);
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
        }

        .property-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
        }

        .property-title h2 {
            font-size: 28px;
            color: var(--text);
            margin-bottom: 8px;
        }

        .property-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            font-size: 16px;
        }

        .property-location i {
            color: var(--primary);
        }

        .property-rating {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .rating-stars {
            color: #ffc107;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .rating-value {
            font-size: 18px;
            font-weight: 600;
            color: var(--text);
        }

        .property-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: var(--secondary);
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
            font-weight: 500;
            color: var(--text);
        }

        .price-tag {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 24px;
            border-radius: var(--radius);
            text-align: center;
            margin: 24px 0;
        }

        .price-label {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .price-amount {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .price-note {
            font-size: 14px;
            opacity: 0.9;
        }

        /* ===== FACILITIES ===== */
        .facilities-section {
            margin: 24px 0;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 16px;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
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
            background: var(--secondary);
            border-radius: 8px;
        }

        .facility-item i {
            color: var(--primary);
            width: 20px;
        }

        /* ===== BOOKING FORM ===== */
        .booking-form-container {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 100px;
        }

        .booking-form h3 {
            font-size: 22px;
            margin-bottom: 20px;
            color: var(--text);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text);
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
        }

        .date-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .book-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--accent), #e65100);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(255, 109, 0, 0.3);
        }

        .policies-box {
            background: #e3f2fd;
            border-left: 4px solid var(--primary);
            padding: 16px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .policies-box h4 {
            margin-bottom: 8px;
            color: var(--primary);
        }

        /* ===== ROOM TYPES ===== */
        .room-section {
            background: white;
            border-radius: var(--radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
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
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
            color: var(--text);
        }

        .room-price {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }

        .room-facilities {
            margin: 16px 0;
            color: var(--text-light);
            font-size: 14px;
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
            color: #4caf50;
            font-weight: 500;
        }

        .status-booked {
            color: #ff9800;
            font-weight: 500;
        }

        .status-occupied {
            color: #f44336;
            font-weight: 500;
        }

        .status-maintenance {
            color: #9e9e9e;
            font-weight: 500;
        }

        .room-book-btn {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        .room-book-btn:hover {
            background: var(--primary-dark);
        }

        /* ===== RESPONSIVE DESIGN ===== */
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
                flex-direction: column;
                gap: 16px;
            }
            
            .search-form {
                width: 100%;
            }
            
            .search-form input {
                width: 100%;
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
    </style>
</head>
<body>
    <!-- HEADER -->
    <header>
        <div class="logo">
            <i class="fas fa-crown"></i>
            <h1>Luxury Stay</h1>
        </div>
        <form class="search-form" action="{{ route('property.search') }}" method="GET">
            <input type="text" name="search" placeholder="Cari hotel atau kota..." value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i> Cari</button>
        </form>
    </header>

    <!-- MAIN CONTENT -->
    <div class="main-container">
        <!-- PHOTO GALLERY -->
        <div class="photo-section">
            @php
                $imagePath = public_path('images/' . $property->foto);
            @endphp

            @if($property->foto && file_exists($imagePath))
                <img src="{{ asset('images/' . $property->foto) }}" alt="{{ $property->name }}" class="main-photo">
            @else
                <img src="{{ asset('images/default-hotel.jpg') }}" alt="Hotel Default" class="main-photo">
            @endif
            
            <div class="photo-thumbnails">
                <!-- In a real application, you would loop through multiple property images -->
                <img src="{{ asset('images/' . $property->foto) }}" alt="Thumbnail 1" class="thumbnail">
                <img src="{{ asset('images/default-hotel.jpg') }}" alt="Thumbnail 2" class="thumbnail">
                <img src="{{ asset('images/default-hotel.jpg') }}" alt="Thumbnail 3" class="thumbnail">
                <img src="{{ asset('images/default-hotel.jpg') }}" alt="Thumbnail 4" class="thumbnail">
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
                        @foreach(explode(',', $property->fasilitas ?? '') as $facility)
                            @if(trim($facility) !== '')
                                <div class="facility-item">
                                    <i class="fas fa-check"></i>
                                    <span>{{ trim($facility) }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- BOOKING FORM -->
            <div class="booking-form-container">
                <div class="booking-form">
                    <h3>Pesan Sekarang</h3>
                    <form action="{{ route('booking.create') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">
                        <input type="hidden" name="hotel_id" value="{{ $property->hotel_id }}">

                        <div class="form-group">
                            <label for="checkin_date">Tanggal Check-in</label>
                            <input type="date" name="checkin_date" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label for="checkout_date">Tanggal Check-out</label>
                            <input type="date" name="checkout_date" class="form-control" required>
                        </div>

                        <button type="submit" class="book-btn">
                            <i class="fas fa-calendar-check"></i> Booking Sekarang
                        </button>
                    </form>

                    <div class="policies-box">
                        <h4><i class="fas fa-info-circle"></i> Kebijakan Hotel</h4>
                        <p>{{ $property->hotel->policies ?? 'Tidak ada kebijakan khusus.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROOM TYPES -->
        <div class="room-section">
            <h3 class="section-title"><i class="fas fa-bed"></i> Pilihan Tipe Kamar di {{ $property->name }}</h3>
            
            <div class="room-grid">
                @forelse($tipeKamars as $tipe)
                    <div class="room-card">
                        <!-- ROOM IMAGE -->
                        <div class="room-photo">
                            @php
                                $fotoPath = public_path('images/tipe_kamar/' . $tipe->foto);
                            @endphp

                            @if($tipe->foto && file_exists($fotoPath))
                                <img src="{{ asset('images/tipe_kamar/' . $tipe->foto) }}" alt="{{ $tipe->name }}" class="room-image">
                            @else
                                <img src="{{ asset('images/default-room.jpg') }}" alt="Default Room" class="room-image">
                            @endif
                        </div>

                        <!-- ROOM INFO -->
                        <div class="room-content">
                            <div class="room-header">
                                <h4 class="room-title">{{ $tipe->name }}</h4>
                                <div class="room-price">Rp {{ number_format($tipe->harga, 0, ',', '.') }}</div>
                            </div>
                            
                            <p class="room-facilities">{{ $tipe->fasilitas_kamar ?? 'Fasilitas belum tersedia.' }}</p>

                            @if($tipe->kamars->count() > 0)
                                <div class="room-status">
                                    <p><strong>Status Kamar:</strong></p>
                                    @foreach($tipe->kamars as $kamar)
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
                            <form action="{{ route('booking.create') }}" method="GET">
                                <input type="hidden" name="tipe_kamar_id" value="{{ $tipe->id }}">
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <button type="submit" class="room-book-btn">
                                    <i class="fas fa-calendar-plus"></i> Pilih Kamar Ini
                                </button>
                            </form>
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
        // Simple date validation
        document.addEventListener('DOMContentLoaded', function() {
            const checkinInput = document.querySelector('input[name="checkin_date"]');
            const checkoutInput = document.querySelector('input[name="checkout_date"]');
            
            // Set minimum checkout date based on checkin date
            checkinInput.addEventListener('change', function() {
                checkoutInput.min = this.value;
                
                // If checkout date is before new checkin date, reset it
                if (checkoutInput.value && checkoutInput.value < this.value) {
                    checkoutInput.value = '';
                }
            });
            
            // Thumbnail click handler
            const thumbnails = document.querySelectorAll('.thumbnail');
            const mainPhoto = document.querySelector('.main-photo');
            
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    mainPhoto.src = this.src;
                });
            });
        });
    </script>
</body>
</html>