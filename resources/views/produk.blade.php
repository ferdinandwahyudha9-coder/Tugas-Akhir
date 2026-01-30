<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Produk - Nand Second</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk - Nand Second</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script>
    (function() {
      const theme = localStorage.getItem('theme');
      if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
    })();
  </script>
  <style>
    /* Page Specific Styles */
    .hero-banner {
      background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
      color: white;
      padding: 60px 50px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero-banner::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: url("{{ asset('images/lctb.jpeg') }}");
      background-size: cover;
      background-position: center;
      opacity: 0.15;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-banner h1 {
      font-size: 3rem;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .hero-banner p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    /* Filter & Sort Section */
    .filter-section {
      background: white;
      padding: 25px 50px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .filter-left {
      display: flex;
      gap: 15px;
      align-items: center;
      flex-wrap: wrap;
    }

    .filter-btn {
      padding: 10px 20px;
      border: 2px solid #e0e0e0;
      background: white;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s;
      font-size: 0.9rem;
    }

    .filter-btn:hover {
      border-color: #aaa;
    }

    .filter-btn.active {
      background: #111;
      color: white;
      border-color: #111;
    }

    .sort-select {
      padding: 10px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      background: white;
      font-size: 0.9rem;
    }

    .sort-select:focus {
      outline: none;
      border-color: #111;
    }

    .product-count {
      color: #666;
      font-size: 0.95rem;
    }

    /* Products Grid */
    .produk-container {
      display:grid;
      grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
      gap:30px;
      padding:40px 50px 80px;
      max-width: 1400px;
      margin: 0 auto;
    }

    .produk-card {
      position:relative;
      overflow:hidden;
      border-radius:12px;
      cursor:pointer;
      background:#fff;
      border:1px solid #eee;
      transition:all 0.3s;
      display: flex;
      flex-direction: column;
    }

    .produk-card:hover {
      transform:translateY(-10px);
      box-shadow:0 15px 40px rgba(0,0,0,0.15);
    }

    .produk-image-wrapper {
      position: relative;
      overflow: hidden;
      height: 350px;
    }

    .produk-card img {
      width:100%;
      height:100%;
      object-fit:cover;
      transition: transform 0.5s ease;
    }

    .produk-card:hover img {
      transform:scale(1.1);
    }

    /* Quick View Badge */
    .quick-view {
      position: absolute;
      top: 15px;
      right: 15px;
      background: rgba(255,255,255,0.9);
      padding: 8px 12px;
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s;
    }

    .produk-card:hover .quick-view {
      opacity: 1;
      transform: translateY(0);
    }

    /* Product Info */
    .produk-info {
      padding: 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .produk-nama {
      font-size: 1.1rem;
      font-weight: 600;
      color: #111;
      margin-bottom: 10px;
      line-height: 1.4;
    }

    .produk-harga {
      font-size: 1.3rem;
      font-weight: 700;
      color: #10b981;
      margin-bottom: 15px;
    }

    .produk-actions {
      display: flex;
      gap: 10px;
      margin-top: auto;
    }

    .btn {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 5px;
    }

    .btn-cart {
      background: #f3f4f6;
      color: #111;
    }

    .btn-cart:hover {
      background: #e5e7eb;
      transform: translateY(-2px);
    }

    .btn-buy {
      background: #111;
      color: white;
    }

    .btn-buy:hover {
      background: #000;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 80px 20px;
      grid-column: 1 / -1;
    }

    .empty-state-icon {
      font-size: 5rem;
      margin-bottom: 20px;
      opacity: 0.3;
    }

    .empty-state h3 {
      font-size: 1.8rem;
      color: #666;
      margin-bottom: 10px;
    }

    .empty-state p {
      color: #999;
      font-size: 1rem;
    }

    /* Responsive */
    @media(max-width:768px){
      /* Existing Page Specific Styles */
      .hero-banner {
        padding: 40px 20px;
      }

      .hero-banner h1 {
        font-size: 2rem;
      }

      .hero-banner p {
        font-size: 1rem;
      }

      .filter-section {
        padding: 20px;
        flex-direction: column;
        align-items: flex-start;
      }

      .filter-left {
        width: 100%;
      }

      .produk-container {
        padding: 30px 20px;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 15px;
      }

      .produk-image-wrapper {
        height: 200px;
      }
    }

    /* Centered Navigation for Desktop */
    @media (min-width: 769px) {
      .nav-links {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 30px;
      }
    }
    
    @media (max-width: 768px) {
      .nav-links {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
        gap: 20px;
      }
    }
  </style>
</head>
<body>

<header>
  <h1 onclick="window.location.href='{{route('beranda')}}'">Nand Second</h1>
  <div class="hamburger" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav>
    <div class="nav-links">
      <a href="{{route('beranda')}}">Beranda</a>
      <a href="{{route('produk')}}" class="active">Produk</a>
      <a href="{{route('beranda')}}#story">Sejarah</a>
      <a href="{{ route('beranda') }}#contact">Kontak</a>
    </div>


    <div class="nav-right">
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari produk...">
        <img src="{{ asset('images/download.jpg') }}" alt="Search">
      </div>

      <button onclick="toggleDarkMode()" class="icon-btn" title="Toggle Dark Mode" style="margin-right: 15px;">
        <!-- Moon Icon -->
        <svg class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        <!-- Sun Icon -->
        <svg class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
      </button>

      <button class="icon-btn" onclick="window.location.href='{{route('keranjang')}}'" title="Keranjang">
        <img src="{{ asset('images/keranjang.jpg') }}" alt="Keranjang">
        <span class="cart-badge" id="cartBadge">0</span>
      </button>

      <!-- USER MENU -->
      @auth
      <div class="user-menu" onclick="window.location.href='{{ route('profil') }}'" style="display: flex; align-items: center; gap: 8px; cursor: pointer; margin-left: 10px;">
          <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.8rem;">
              {{ substr(Auth::user()->name, 0, 1) }}
          </div>
          <span style="font-size: 0.9rem; font-weight: 500; color: #333;" class="hidden md:block">{{ explode(' ', Auth::user()->name)[0] }}</span>
      </div>
      @else
      <a href="{{ route('login') }}" style="margin-left: 10px; font-weight: 500; color: #333;">Login</a>
      @endauth

    </div><!-- End nav-right -->

  </nav>
</header>

<!-- Hero Banner -->
<section class="hero-banner">
  <div class="hero-content">
    <h1>🔥 Our Collection</h1>
    <p>Temukan style casual football culture yang autentik</p>
  </div>
</section>

<!-- Filter & Sort Section -->
<section class="filter-section">
  <div class="filter-left">
    <button class="filter-btn active" data-filter="all" onclick="filterProducts('all')">
      Semua Produk
    </button>
    <button class="filter-btn" data-filter="new" onclick="filterProducts('new')">
      🆕 Terbaru
    </button>
    <button class="filter-btn" data-filter="popular" onclick="filterProducts('popular')">
      ⭐ Populer
    </button>
    <button class="filter-btn" data-filter="sale" onclick="filterProducts('sale')">
      🔥 Promo
    </button>
  </div>

  <div style="display: flex; gap: 15px; align-items: center;">
    <span class="product-count" id="productCount">Menampilkan 4 produk</span>
    <select class="sort-select" id="sortSelect" onchange="sortProducts()">
      <option value="default">Urutkan</option>
      <option value="name-asc">Nama: A-Z</option>
      <option value="name-desc">Nama: Z-A</option>
      <option value="price-asc">Harga: Terendah</option>
      <option value="price-desc">Harga: Tertinggi</option>
    </select>
  </div>
</section>

<!-- Products Grid -->
<section class="produk-container" id="produkContainer">
  <!-- Products will be rendered here -->
</section>

<script>
// Product Data
// Product Data
const produkList = @json($products);

let currentProducts = [...produkList];
let currentFilter = 'all';

// Update cart badge
function updateCartBadge() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const badge = document.getElementById('cartBadge');
  badge.textContent = cart.length;
  badge.style.display = cart.length > 0 ? 'flex' : 'none';
}

// Render products
function renderProduk(products) {
  const container = document.getElementById('produkContainer');
  const productCount = document.getElementById('productCount');

  if (products.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <div class="empty-state-icon">🔍</div>
        <h3>Produk Tidak Ditemukan</h3>
        <p>Coba kata kunci lain atau reset filter</p>
      </div>
    `;
    productCount.textContent = 'Tidak ada produk';
    return;
  }

  productCount.textContent = `Menampilkan ${products.length} produk`;

  container.innerHTML = '';
  products.forEach(produk => {
    const card = document.createElement('div');
    card.className = 'produk-card';
    card.innerHTML = `
      <div class="produk-image-wrapper">
        <img src="${produk.image}" alt="${produk.nama}" onclick="goToDetail(${produk.id})">
        <div class="quick-view">👁️ Lihat Detail</div>
      </div>
      <div class="produk-info">
        <div class="produk-nama">${produk.nama}</div>
        <div class="produk-harga">${produk.hargaStr}</div>
        <div class="produk-actions">
          <button class="btn btn-cart" onclick="addToCart(${produk.id})">
            🛒 Keranjang
          </button>
          <button class="btn btn-buy" onclick="buyNow(${produk.id})">
            ⚡ Beli
          </button>
        </div>
      </div>
    `;
    container.appendChild(card);
  });
}

// Go to detail
function goToDetail(id) {
  window.location.href = `/detail_produk?id=${id}`;
}

// Add to cart
function addToCart(id) {
  const produk = produkList.find(p => p.id === id);
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  cart.push({
    id: produk.id,
    name: produk.nama,
    price: produk.harga,
    image: produk.image
  });

  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartBadge();

  alert(`✅ ${produk.nama} ditambahkan ke keranjang!`);
}

// Buy now
function buyNow(id) {
  const produk = produkList.find(p => p.id === id);
  localStorage.setItem('checkoutItem', JSON.stringify([{
    id: produk.id,
    name: produk.nama,
    price: produk.harga,
    image: produk.image,
    quantity: 1
  }]));
  window.location.href = "{{ route('checkout') }}";
}

// Filter products
function filterProducts(category) {
  currentFilter = category;

  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.classList.remove('active');
  });
  event.target.classList.add('active');

  if (category === 'all') {
    currentProducts = [...produkList];
  } else {
    currentProducts = produkList.filter(p => p.category === category);
  }

  renderProduk(currentProducts);
}

// Sort products
function sortProducts() {
  const sortValue = document.getElementById('sortSelect').value;

  switch(sortValue) {
    case 'name-asc':
      currentProducts.sort((a, b) => a.nama.localeCompare(b.nama));
      break;
    case 'name-desc':
      currentProducts.sort((a, b) => b.nama.localeCompare(a.nama));
      break;
    case 'price-asc':
      currentProducts.sort((a, b) => a.harga - b.harga);
      break;
    case 'price-desc':
      currentProducts.sort((a, b) => b.harga - a.harga);
      break;
    default:
      currentProducts = [...produkList];
  }

  renderProduk(currentProducts);
}

// Search products
const searchInput = document.getElementById('searchInput');
searchInput.addEventListener('input', () => {
  const keyword = searchInput.value.toLowerCase().trim();

  if (keyword === '') {
    currentProducts = currentFilter === 'all'
      ? [...produkList]
      : produkList.filter(p => p.category === currentFilter);
  } else {
    const filtered = produkList.filter(p =>
      p.nama.toLowerCase().includes(keyword)
    );
    currentProducts = filtered;
  }

  renderProduk(currentProducts);
});

function toggleMenu() {
  const nav = document.querySelector('nav');
  const hamburger = document.querySelector('.hamburger');
  nav.classList.toggle('active');
  hamburger.classList.toggle('active');
}

// Initialize
updateCartBadge();
renderProduk(produkList);

// Handle URL search params
const urlParams = new URLSearchParams(window.location.search);
const searchQuery = urlParams.get('search');
if (searchQuery) {
  searchInput.value = searchQuery;
  searchInput.dispatchEvent(new Event('input'));
}
</script>

</body>
</html>