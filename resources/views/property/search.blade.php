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
    <div class="sidebar">
      <div class="sidebar-header">
        <h3><i class="fas fa-sliders-h"></i> Filter Pencarian</h3>
        <button type="button" class="clear-btn" onclick="window.location='{{ route('property.search') }}'">
          <i class="fas fa-times"></i> Hapus Semua
        </button>
      </div>

      <form action="{{ route('property.search') }}" method="GET">
        <!-- FILTER HARGA -->
        <div class="filter-section">
          <span class="filter-title"><i class="fas fa-tag"></i> Rentang Harga per Malam</span>
          <div class="price-range">
            <input type="range" class="price-slider" id="minPrice" name="min_price" min="50000" max="2000000" step="50000"
                   value="{{ request('min_price', 100000) }}"
                   oninput="updatePriceValues()">
            <input type="range" class="price-slider" id="maxPrice" name="max_price" min="50000" max="2000000" step="50000"
                   value="{{ request('max_price', 1000000) }}"
                   oninput="updatePriceValues()">
            <div class="price-values">
              <span>Rp <span id="minPriceValue">{{ number_format(request('min_price', 100000), 0, ',', '.') }}</span></span>
              <span>Rp <span id="maxPriceValue">{{ number_format(request('max_price', 1000000), 0, ',', '.') }}</span></span>
            </div>
          </div>
        </div>

        <!-- FILTER KATEGORI -->
        <div class="filter-section">
          <span class="filter-title"><i class="fas fa-list"></i> Kategori Hotel</span>
          <div class="filter-options">
            <div class="filter-option">
              <input type="checkbox" id="oyo" name="category[]" value="OYO Rooms">
              <label for="oyo">OYO Rooms - Super affordable stays</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="premium" name="category[]" value="Premium">
              <label for="premium">Premium - Prime location hotels</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="capital" name="category[]" value="Capital O">
              <label for="capital">Capital O - Spacious for business</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="collection" name="category[]" value="Collection O">
              <label for="collection">Collection O - Modern travellers</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="spot" name="category[]" value="Spot On">
              <label for="spot">Spot On - Budget comfort</label>
            </div>
          </div>
        </div>

        <!-- FILTER FASILITAS -->
        <div class="filter-section">
          <span class="filter-title"><i class="fas fa-concierge-bell"></i> Fasilitas Hotel</span>
          <div class="filter-options" id="facilityList">
            <div class="filter-option">
              <input type="checkbox" id="parking" name="facility[]" value="Parking">
              <label for="parking">Parking Facility</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="pool" name="facility[]" value="Swimming Pool">
              <label for="pool">Swimming Pool</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="kitchen" name="facility[]" value="Kitchen">
              <label for="kitchen">Kitchen</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="geyser" name="facility[]" value="Geyser">
              <label for="geyser">Geyser</label>
            </div>
            <div class="filter-option">
              <input type="checkbox" id="tv" name="facility[]" value="TV">
              <label for="tv">TV</label>
            </div>

            <div id="moreFacilities" style="display:none;">
              <div class="filter-option">
                <input type="checkbox" id="ac" name="facility[]" value="AC">
                <label for="ac">AC</label>
              </div>
              <div class="filter-option">
                <input type="checkbox" id="wifi" name="facility[]" value="WiFi">
                <label for="wifi">WiFi</label>
              </div>
              <div class="filter-option">
                <input type="checkbox" id="restaurant" name="facility[]" value="Restaurant">
                <label for="restaurant">Restaurant</label>
              </div>
              <div class="filter-option">
                <input type="checkbox" id="gym" name="facility[]" value="Gym">
                <label for="gym">Gym</label>
              </div>
              <div class="filter-option">
                <input type="checkbox" id="reception" name="facility[]" value="24h Reception">
                <label for="reception">24h Reception</label>
              </div>
            </div>

            <span class="view-more" onclick="toggleFacilities()">
              <i class="fas fa-chevron-down" id="facilityIcon"></i>
              <span id="facilityText">Lihat Lebih Banyak</span>
            </span>
          </div>
        </div>

        <button type="submit" class="apply-btn">
          <i class="fas fa-check"></i> Terapkan Filter
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
            <a href="{{ route('booking.create', ['property_id' => $property->id]) }}" class="book-btn">
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

    function updatePriceValues() {
      const minPrice = document.getElementById("minPrice").value;
      const maxPrice = document.getElementById("maxPrice").value;

      document.getElementById("minPriceValue").textContent =
        new Intl.NumberFormat('id-ID').format(minPrice);
      document.getElementById("maxPriceValue").textContent =
        new Intl.NumberFormat('id-ID').format(maxPrice);
    }

    // Initialize price values on page load
    document.addEventListener('DOMContentLoaded', function() {
      updatePriceValues();
    });
  </script>

</body>
</html>