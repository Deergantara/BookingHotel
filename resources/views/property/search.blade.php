<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pencarian Hotel - Luxury Allure</title>
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
      background-color: #f8fafc;
      color: var(--text);
      line-height: 1.6;
    }

    /* ===== HEADER ===== */
    .header {
      background: var(--primary);
      border-bottom: 1px solid #333;
      padding: 16px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
      color: var(--accent);
      font-weight: 700;
      margin: 0;
      font-size: 24px;
      font-family: 'Playfair Display', serif;
    }

    .search-form {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .search-form input {
      padding: 12px 20px;
      width: 400px;
      border-radius: 24px;
      border: 1px solid #333;
      font-size: 15px;
      transition: all 0.3s ease;
      background: var(--primary-light);
      color: white;
    }

    .search-form input::placeholder {
      color: #999;
    }

    .search-form input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
    }

    .search-btn {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      color: var(--primary);
      border: none;
      padding: 12px 24px;
      border-radius: 24px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .search-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    /* ===== LAYOUT ===== */
    .container {
      display: flex;
      max-width: 1400px;
      margin: 30px auto;
      gap: 30px;
      padding: 0 20px;
    }

    /* ===== SIDEBAR ===== */
    .sidebar {
      width: 350px;
      background: white;
      padding: 24px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      height: fit-content;
      position: sticky;
      top: 100px;
      max-height: calc(100vh - 120px);
      overflow-y: auto;
      border: 1px solid var(--border);
    }

    .sidebar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 16px;
      border-bottom: 2px solid var(--accent);
    }

    .sidebar-header h3 {
      margin: 0;
      font-size: 18px;
      color: var(--primary);
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .sidebar-header i {
      color: var(--accent);
    }

    .clear-btn {
      font-size: 13px;
      color: #dc2626;
      background: none;
      border: none;
      cursor: pointer;
      font-weight: 500;
      transition: color 0.2s;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .clear-btn:hover {
      color: #b91c1c;
    }

    .filter-section {
      margin-bottom: 24px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
    }

    .filter-section:last-child {
      border-bottom: none;
    }

    .filter-title {
      font-weight: 600;
      display: block;
      margin-bottom: 16px;
      color: var(--primary);
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 15px;
    }

    .filter-title i {
      color: var(--accent);
      width: 16px;
    }

    /* Price Range Slider */
    .price-range {
      margin-bottom: 10px;
    }

    .price-slider {
      width: 100%;
      height: 6px;
      border-radius: 5px;
      background: #e5e7eb;
      outline: none;
      -webkit-appearance: none;
    }

    .price-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--accent);
      cursor: pointer;
      border: 2px solid white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .price-values {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin-top: 12px;
      color: var(--text-light);
      font-weight: 500;
    }

    /* Filter Options */
    .filter-options {
      margin-top: 8px;
    }

    .filter-option {
      display: flex;
      align-items: center;
      margin: 12px 0;
      cursor: pointer;
      padding: 4px 0;
    }

    .filter-option input {
      margin-right: 12px;
      width: 16px;
      height: 16px;
      accent-color: var(--accent);
    }

    .filter-option label {
      cursor: pointer;
      font-size: 14px;
      color: var(--text);
      transition: color 0.2s;
    }

    .filter-option:hover label {
      color: var(--accent);
    }

    .view-more {
      color: var(--accent);
      font-size: 14px;
      cursor: pointer;
      font-weight: 600;
      margin-top: 12px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
      padding: 4px 8px;
      border-radius: 6px;
    }

    .view-more:hover {
      background: rgba(212, 175, 55, 0.1);
    }

    .apply-btn {
      width: 100%;
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      color: var(--primary);
      border: none;
      padding: 16px;
      border-radius: 10px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 16px;
      font-size: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .apply-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    /* ===== RESULTS ===== */
    .results {
      flex: 1;
    }

    .result-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      background: white;
      padding: 24px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .result-count {
      font-size: 18px;
      font-weight: 700;
      color: var(--primary);
    }

    .sort-select {
      padding: 12px 16px;
      border-radius: 8px;
      border: 1px solid var(--border);
      font-size: 14px;
      background: white;
      cursor: pointer;
      color: var(--text);
      font-weight: 500;
    }

    .sort-select:focus {
      outline: none;
      border-color: var(--accent);
    }

    /* ===== PROPERTY CARD ===== */
    .property-card {
      display: flex;
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      margin-bottom: 24px;
      overflow: hidden;
      transition: all 0.3s ease;
      border: 1px solid var(--border);
      position: relative;
    }

    .property-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0,0,0,0.15);
      border-color: var(--accent);
    }

    .property-image {
      width: 300px;
      height: 220px;
      object-fit: cover;
      border-right: 1px solid var(--border);
      transition: transform 0.3s ease;
    }

    .property-card:hover .property-image {
      transform: scale(1.05);
    }

    .property-content {
      padding: 24px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .property-header {
      margin-bottom: 16px;
    }

    .property-name {
      margin: 0 0 12px;
      font-size: 22px;
      color: var(--primary);
      font-weight: 700;
      font-family: 'Playfair Display', serif;
    }

    .property-location {
      display: flex;
      align-items: center;
      gap: 8px;
      color: var(--text-light);
      font-size: 14px;
      margin-bottom: 12px;
    }

    .property-location i {
      color: var(--accent);
    }

    .property-rating {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 12px;
    }

    .rating-stars {
      color: var(--accent);
    }

    .rating-value {
      font-weight: 700;
      color: var(--primary);
      background: rgba(212, 175, 55, 0.1);
      padding: 4px 8px;
      border-radius: 6px;
    }

    .property-price {
      color: var(--accent);
      font-weight: 800;
      font-size: 24px;
      margin: 16px 0;
    }

    .property-actions {
      display: flex;
      gap: 12px;
      margin-top: 20px;
    }

    .view-btn, .book-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .view-btn {
      border: 2px solid var(--accent);
      color: var(--accent);
      background: white;
    }

    .view-btn:hover {
      background: var(--accent);
      color: white;
      transform: translateY(-2px);
    }

    .book-btn {
      background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
      color: var(--primary);
      border: none;
      font-weight: 700;
    }

    .book-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .no-result {
      background: white;
      padding: 60px 40px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      text-align: center;
      color: var(--text-light);
      border: 1px solid var(--border);
    }

    .no-result i {
      font-size: 64px;
      color: #e5e7eb;
      margin-bottom: 20px;
    }

    .no-result p {
      font-size: 18px;
      margin: 0;
      font-weight: 500;
    }

    /* ===== BADGE ===== */
    .property-badge {
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

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 1024px) {
      .container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        position: static;
        max-height: none;
      }

      .property-image {
        width: 260px;
      }
    }

    @media (max-width: 768px) {
      .header {
        flex-direction: column;
        gap: 16px;
        padding: 16px 20px;
      }

      .search-form {
        width: 100%;
      }

      .search-form input {
        width: 100%;
      }

      .property-card {
        flex-direction: column;
      }

      .property-image {
        width: 100%;
        height: 200px;
      }

      .result-header {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
      }

      .property-actions {
        flex-direction: column;
      }
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
    <form class="search-form" action="{{ route('property.search') }}" method="GET">
      <input type="text" name="search" placeholder="Cari nama hotel, kota, atau destinasi..." value="{{ request('search') }}">
      <button type="submit" class="search-btn">
        <i class="fas fa-search"></i> Cari
      </button>
    </form>
  </div>

  <div class="container">
    <!-- SIDEBAR FILTER -->
<!-- SIDEBAR FILTER -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-sliders-h"></i> Filter Pencarian</h3>
        <a href="{{ route('property.search') }}" class="clear-btn">
            <i class="fas fa-times"></i> Hapus Semua
        </a>
    </div>

    <form action="{{ route('property.search') }}" method="GET" id="filterForm">
        <!-- Simpan parameter pencarian -->
        @if(request('search'))
        <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

        <!-- FILTER HARGA -->
        <div class="filter-section">
            <span class="filter-title"><i class="fas fa-tag"></i> Rentang Harga per Malam</span>
            <div class="price-range">
                <input type="range" class="price-slider" id="minPrice" name="min_price" 
                       min="{{ $filterData['min_price_available'] }}" 
                       max="{{ $filterData['max_price_available'] }}" 
                       step="50000"
                       value="{{ request('min_price', $filterData['min_price_available']) }}"
                       oninput="updatePriceValues()">
                <input type="range" class="price-slider" id="maxPrice" name="max_price" 
                       min="{{ $filterData['min_price_available'] }}" 
                       max="{{ $filterData['max_price_available'] }}" 
                       step="50000"
                       value="{{ request('max_price', $filterData['max_price_available']) }}"
                       oninput="updatePriceValues()">
                <div class="price-values">
                    <span>Rp <span id="minPriceValue">{{ number_format(request('min_price', $filterData['min_price_available']), 0, ',', '.') }}</span></span>
                    <span>Rp <span id="maxPriceValue">{{ number_format(request('max_price', $filterData['max_price_available']), 0, ',', '.') }}</span></span>
                </div>
            </div>
        </div>

        <!-- FILTER LOKASI -->
        <div class="filter-section">
            <span class="filter-title"><i class="fas fa-map-marker-alt"></i> Lokasi</span>
            <div class="filter-options">
                @foreach($filterData['cities'] as $city)
                <div class="filter-option">
                    <input type="checkbox" id="city-{{ Str::slug($city) }}" name="cities[]" value="{{ $city }}" 
                           {{ in_array($city, request('cities', [])) ? 'checked' : '' }}>
                    <label for="city-{{ Str::slug($city) }}">{{ $city }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- FILTER RATING -->
        <div class="filter-section">
            <span class="filter-title"><i class="fas fa-star"></i> Rating Hotel</span>
            <div class="filter-options">
                @for($i = 5; $i >= 1; $i--)
                <div class="filter-option">
                    <input type="checkbox" id="rating-{{ $i }}" name="ratings[]" value="{{ $i }}" 
                           {{ in_array($i, request('ratings', [])) ? 'checked' : '' }}>
                    <label for="rating-{{ $i }}">
                        @for($j = 1; $j <= 5; $j++)
                            <i class="fas fa-star{{ $j <= $i ? '' : '-o' }}" style="color: {{ $j <= $i ? '#d4af37' : '#ccc' }}"></i>
                        @endfor
                        <span style="margin-left: 8px;">{{ $i }}+ bintang</span>
                    </label>
                </div>
                @endfor
            </div>
        </div>

        <!-- FILTER FASILITAS -->
        <div class="filter-section">
            <span class="filter-title"><i class="fas fa-concierge-bell"></i> Fasilitas Hotel</span>
            <div class="filter-options" id="facilityList">
                @php
                    $facilities = $filterData['facilities'];
                    $selectedFacilities = request('facilities', []);
                    $showMore = count($facilities) > 5;
                @endphp

                @foreach($facilities->take(5) as $index => $facility)
                <div class="filter-option">
                    <input type="checkbox" id="facility-{{ $index }}" name="facilities[]" value="{{ $facility }}" 
                           {{ in_array($facility, $selectedFacilities) ? 'checked' : '' }}>
                    <label for="facility-{{ $index }}">{{ $facility }}</label>
                </div>
                @endforeach

                @if($showMore)
                <div id="moreFacilities" style="display:none;">
                    @foreach($facilities->skip(5) as $index => $facility)
                    <div class="filter-option">
                        <input type="checkbox" id="facility-{{ $index + 5 }}" name="facilities[]" value="{{ $facility }}" 
                               {{ in_array($facility, $selectedFacilities) ? 'checked' : '' }}>
                        <label for="facility-{{ $index + 5 }}">{{ $facility }}</label>
                    </div>
                    @endforeach
                </div>

                <span class="view-more" onclick="toggleFacilities()">
                    <i class="fas fa-chevron-down" id="facilityIcon"></i>
                    <span id="facilityText">Lihat Lebih Banyak</span>
                </span>
                @endif
            </div>
        </div>

        <!-- SORTING -->
        <div class="filter-section">
            <span class="filter-title"><i class="fas fa-sort"></i> Urutkan</span>
            <select class="sort-select w-full p-3 border border-gray-300 rounded-lg" name="sort" onchange="document.getElementById('filterForm').submit()">
                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Harga Tertinggi</option>
                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
            </select>
        </div>

        <button type="submit" class="apply-btn">
            <i class="fas fa-filter"></i> Terapkan Filter
        </button>
    </form>
</div>

    <!-- HASIL PENCARIAN -->
    <div class="results">
      <div class="result-header">
        <div class="result-count">{{ $properties->count() }} Properti Ditemukan</div>
        <select class="sort-select">
          <option>Urutkan: Populer</option>
          <option>Harga Terendah</option>
          <option>Harga Tertinggi</option>
          <option>Rating Tertinggi</option>
        </select>
      </div>

      @forelse($properties as $property)
      <div class="property-card">
        @php
          // Handle foto property
          $fotoPath = 'images/default-hotel.jpg';
          if (!empty($property->foto)) {
              if (is_array($property->foto) && count($property->foto) > 0) {
                  $fotoPath = 'storage/' . $property->foto[0];
              } elseif (is_string($property->foto)) {
                  $fotoPath = 'storage/' . $property->foto;
              }
          }

          // Ambil harga terendah
          $lowestPrice = \App\Models\TipeKamar::where('property_id', $property->id)
              ->orderBy('harga', 'asc')
              ->value('harga') ?? 250000;

          // Ambil rating rata-rata
          $rating = \App\Models\Review::where('property_id', $property->id)
              ->avg('star') ?? 5.0;
        @endphp

        <img src="{{ asset($fotoPath) }}" alt="{{ $property->name }}" class="property-image">

        <div class="property-content">
          <div class="property-header">
            <h3 class="property-name">{{ $property->name }}</h3>
            <div class="property-location">
              <i class="fas fa-map-marker-alt"></i>
              <span>{{ $property->city }}, {{ $property->area }}</span>
            </div>
            <div class="property-rating">
              <div class="rating-stars">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star{{ $i <= round($rating) ? '' : '-half-alt' }}"></i>
                @endfor
              </div>
              <span class="rating-value">{{ number_format($rating, 1) }}</span>
            </div>
            <div class="property-location">
              <i class="fas fa-user"></i>
              <span>{{ $property->kapasitas_tamu ?? 2 }} tamu</span>
            </div>
          </div>

          <div class="property-price">
            Rp {{ number_format($lowestPrice, 0, ',', '.') }} / malam
          </div>

          <div class="property-actions">
            <a href="{{ route('property.show', $property->id) }}" class="view-btn">
              <i class="fas fa-eye"></i> Lihat Detail
            </a>
            <a href="{{ route('booking.create', $property->id) }}?checkin={{ $searchData['checkin'] ?? now()->format('Y-m-d') }}&checkout={{ $searchData['checkout'] ?? now()->addDay()->format('Y-m-d') }}&total_guests={{ $searchData['guests'] ?? 2 }}&total_rooms={{ $searchData['rooms'] ?? 1 }}"
            class="book-btn">
                <i class="fas fa-calendar-check"></i> Pesan Sekarang
            </a>
          </div>
        </div>
      </div>
      @empty
      <div class="no-result">
        <i class="fas fa-search"></i>
        <p>Tidak ada properti yang ditemukan.</p>
      </div>
      @endforelse
    </div>
  </div>

  <script>
// Toggle fasilitas
function toggleFacilities() {
    const more = document.getElementById("moreFacilities");
    const text = document.getElementById("facilityText");
    const icon = document.getElementById("facilityIcon");

    if (more.style.display === "none") {
        more.style.display = "block";
        text.textContent = "Lihat Lebih Sedikit";
        icon.className = "fas fa-chevron-up";
    } else {
        more.style.display = "none";
        text.textContent = "Lihat Lebih Banyak";
        icon.className = "fas fa-chevron-down";
    }
}

    // Update nilai harga
function updatePriceValues() {
    const minPrice = document.getElementById("minPrice").value;
    const maxPrice = document.getElementById("maxPrice").value;

    document.getElementById("minPriceValue").textContent = 
        new Intl.NumberFormat('id-ID').format(minPrice);
    document.getElementById("maxPriceValue").textContent = 
        new Intl.NumberFormat('id-ID').format(maxPrice);
}

// Auto-submit form ketika filter berubah (opsional)
function setupAutoFilter() {
    const inputs = document.querySelectorAll('#filterForm input[type="checkbox"], #filterForm input[type="range"]');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            // Untuk range slider, tunggu sedikit agar tidak terlalu sering submit
            if (this.type === 'range') {
                clearTimeout(window.sliderTimeout);
                window.sliderTimeout = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            } else {
                document.getElementById('filterForm').submit();
            }
        });
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePriceValues();
    setupAutoFilter();
});
  </script>

</body>
</html>
