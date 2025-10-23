<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pencarian Hotel - Luxury Stay</title>
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
      background-color: #f8fafc;
      color: var(--text);
      line-height: 1.6;
    }

    /* ===== HEADER ===== */
    .header {
      background: white;
      border-bottom: 1px solid var(--border);
      padding: 16px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo i {
      font-size: 24px;
      color: var(--primary);
    }

    .logo h1 {
      color: var(--primary);
      font-weight: 700;
      margin: 0;
      font-size: 24px;
    }

    .search-form {
      display: flex;
      gap: 10px;
    }

    .search-form input {
      padding: 12px 16px;
      width: 300px;
      border-radius: 24px;
      border: 1px solid var(--border);
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .search-form input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 2px rgba(26, 115, 232, 0.2);
    }

    .search-form button {
      background: var(--primary);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 24px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .search-form button:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
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
      width: 320px;
      background: white;
      padding: 24px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      height: fit-content;
      position: sticky;
      top: 100px;
      max-height: calc(100vh - 120px);
      overflow-y: auto;
    }

    .sidebar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 12px;
      border-bottom: 2px solid var(--primary);
    }

    .sidebar-header h3 {
      margin: 0;
      font-size: 18px;
      color: var(--text);
    }

    .clear-btn {
      font-size: 13px;
      color: #d93025;
      background: none;
      border: none;
      cursor: pointer;
      font-weight: 500;
      transition: color 0.2s;
    }

    .clear-btn:hover {
      color: #b31412;
    }

    .filter-section {
      margin-bottom: 24px;
      padding-bottom: 16px;
      border-bottom: 1px solid var(--border);
    }

    .filter-section:last-child {
      border-bottom: none;
    }

    .filter-title {
      font-weight: 600;
      display: block;
      margin-bottom: 12px;
      color: var(--text);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-title i {
      color: var(--primary);
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
      background: #ddd;
      outline: none;
      -webkit-appearance: none;
    }

    .price-slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--primary);
      cursor: pointer;
    }

    .price-values {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin-top: 8px;
      color: var(--text-light);
    }

    /* Filter Options */
    .filter-options {
      margin-top: 8px;
    }

    .filter-option {
      display: flex;
      align-items: center;
      margin: 10px 0;
      cursor: pointer;
    }

    .filter-option input {
      margin-right: 10px;
      width: 16px;
      height: 16px;
    }

    .filter-option label {
      cursor: pointer;
      font-size: 14px;
      color: var(--text);
    }

    .view-more {
      color: var(--primary);
      font-size: 14px;
      cursor: pointer;
      font-weight: 500;
      margin-top: 8px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      transition: color 0.2s;
    }

    .view-more:hover {
      color: var(--primary-dark);
    }

    .apply-btn {
      width: 100%;
      background: var(--primary);
      color: white;
      border: none;
      padding: 14px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      font-size: 15px;
    }

    .apply-btn:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* ===== RESULTS ===== */
    .results {
      flex: 1;
    }

    .result-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      background: white;
      padding: 20px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }

    .result-count {
      font-size: 18px;
      font-weight: 600;
      color: var(--text);
    }

    .sort-select {
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid var(--border);
      font-size: 14px;
      background: white;
      cursor: pointer;
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
    }

    .property-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.12);
    }

    .property-image {
      width: 280px;
      height: 200px;
      object-fit: cover;
      border-right: 1px solid var(--border);
    }

    .property-content {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .property-header {
      margin-bottom: 12px;
    }

    .property-name {
      margin: 0 0 8px;
      font-size: 20px;
      color: var(--primary);
      font-weight: 600;
    }

    .property-location {
      display: flex;
      align-items: center;
      gap: 6px;
      color: var(--text-light);
      font-size: 14px;
      margin-bottom: 8px;
    }

    .property-location i {
      color: var(--primary);
    }

    .property-rating {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 8px;
    }

    .rating-stars {
      color: #ffc107;
    }

    .rating-value {
      font-weight: 600;
      color: var(--text);
    }

    .property-price {
      color: var(--primary);
      font-weight: 700;
      font-size: 20px;
      margin: 12px 0;
    }

    .property-actions {
      display: flex;
      gap: 12px;
      margin-top: 16px;
    }

    .view-btn, .book-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .view-btn {
      border: 1px solid var(--primary);
      color: var(--primary);
      background: white;
    }

    .view-btn:hover {
      background: var(--primary);
      color: white;
    }

    .book-btn {
      background: var(--accent);
      color: white;
      border: none;
    }

    .book-btn:hover {
      background: #e65100;
      transform: translateY(-2px);
    }

    .no-result {
      background: white;
      padding: 40px;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      text-align: center;
      color: var(--text-light);
    }

    .no-result i {
      font-size: 48px;
      color: #ddd;
      margin-bottom: 16px;
    }

    .no-result p {
      font-size: 18px;
      margin: 0;
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
        width: 240px;
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
        gap: 12px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    <div class="logo">
      <i class="fas fa-crown"></i>
      <h1>Luxury Stay Finder</h1>
    </div>
    <form class="search-form" action="{{ route('property.search') }}" method="GET">
      <input type="text" name="search" placeholder="Cari nama hotel, kota..." value="{{ request('search') }}">
      <button type="submit"><i class="fas fa-search"></i> Cari</button>
    </form>
  </div>

  <div class="container">
    <!-- SIDEBAR FILTER -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h3><i class="fas fa-sliders-h"></i> Filter Pencarian</h3>
        <button type="button" class="clear-btn" onclick="window.location='{{ route('property.search') }}'">
          <i class="fas fa-times"></i> Clear All
        </button>
      </div>

      <form action="{{ route('property.search') }}" method="GET">
        <!-- FILTER HARGA -->
        <div class="filter-section">
          <span class="filter-title"><i class="fas fa-tag"></i> Harga per Malam</span>
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
              <span id="facilityText">View More</span>
            </span>
          </div>
        </div>

        <button type="submit" class="apply-btn"><i class="fas fa-check"></i> Terapkan Filter</button>
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
              $fotoPath = $property->foto ? 'images/'.$property->foto : 'images/default-hotel.jpg';

              // Ambil harga terendah dari tipe_kamars berdasarkan property_id
    $lowestPrice = \App\Models\TipeKamar::where('property_id', $property->id)
                   ->orderBy('harga', 'asc')
                   ->value('harga') ?? 250000;
          @endphp

          <img src="{{ asset($fotoPath) }}" alt="{{ $property->name }}" class="property-image">

          <div class="property-content">
            <div class="property-header">
              <h3 class="property-name">{{ $property->name }}</h3>
              <div class="property-location">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $property->address }}, {{ $property->city }}</span>
              </div>
              <div class="property-rating">
                <div class="rating-stars">
                  @php
                    $rating = $property->bintang ?? 4.0;
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
                <span class="rating-value">{{ number_format($rating, 1) }}</span>
                <span>• {{ $property->kapasitas_tamu ?? 2 }} tamu</span>
              </div>
              <div class="property-price">Rp {{ number_format($lowestPrice, 0, ',', '.') }} / malam</div>
            </div>

            <div class="property-actions">
              <a href="{{ route('property.show', $property->id) }}" class="view-btn">
                <i class="fas fa-eye"></i> Lihat Detail
              </a>
              <a href="{{ route('Booking.create', ['property_id' => $property->id]) }}" class="book-btn">
                <i class="fas fa-calendar-check"></i> Pesan Sekarang
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="no-result">
          <i class="fas fa-search"></i>
          <p>Tidak ada properti ditemukan untuk pencarian ini.</p>
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
        text.textContent = "View Less";
        icon.className = "fas fa-chevron-up";
      } else {
        more.style.display = "none";
        text.textContent = "View More";
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