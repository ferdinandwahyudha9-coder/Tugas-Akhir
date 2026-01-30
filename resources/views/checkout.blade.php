<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Checkout - Nand Second</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
  color: #222;
  padding-bottom: 40px;
}

header {
  background: rgba(255, 255, 255, 0.98);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  padding: 20px 50px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: sticky;
  top: 0;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  z-index: 100;
  animation: slideDown 0.5s ease;
}

@keyframes slideDown {
  from {
    transform: translateY(-100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

header h1 {
  font-size: 1.8rem;
  font-weight: 700;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

nav a {
  text-decoration: none;
  color: #222;
  margin: 0 20px;
  font-weight: 500;
  font-size: 1rem;
  transition: all 0.3s ease;
  position: relative;
}

nav a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  transition: width 0.3s ease;
}

nav a:hover::after {
  width: 100%;
}

nav a:hover {
  color: #667eea;
}

.checkout-container {
  max-width: 950px;
  margin: 50px auto;
  padding: 40px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  animation: fadeInUp 0.6s ease;
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

.checkout-title {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 30px;
  color: #111;
  position: relative;
  padding-bottom: 15px;
}

.checkout-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 80px;
  height: 4px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 2px;
}

.checkout-items-wrapper {
  max-height: 500px;
  overflow-y: auto;
  padding-right: 10px;
  margin-bottom: 30px;
}

.checkout-items-wrapper::-webkit-scrollbar {
  width: 8px;
}

.checkout-items-wrapper::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.checkout-items-wrapper::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 10px;
}

.checkout-item {
  display: flex;
  align-items: center;
  margin-bottom: 25px;
  padding: 20px;
  background: #f9f9f9;
  border-radius: 15px;
  transition: all 0.3s ease;
  animation: itemSlideIn 0.5s ease forwards;
  opacity: 0;
}

@keyframes itemSlideIn {
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.checkout-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
}

.checkout-item img {
  width: 110px;
  height: 110px;
  object-fit: cover;
  border-radius: 12px;
  margin-right: 25px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.checkout-item:hover img {
  transform: scale(1.05);
}

.item-info {
  flex: 1;
}

.item-name {
  font-weight: 600;
  font-size: 1.1rem;
  margin-bottom: 8px;
  color: #111;
}

.item-price {
  font-size: 1.05rem;
  color: #667eea;
  font-weight: 600;
}

.summary-box {
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  padding: 25px;
  border-radius: 15px;
  margin-bottom: 25px;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  font-size: 1rem;
}

.summary-row.total {
  font-size: 1.4rem;
  font-weight: 700;
  color: #111;
  padding-top: 15px;
  border-top: 2px solid rgba(0, 0, 0, 0.1);
  margin-bottom: 0;
}

.btn-container {
  display: flex;
  gap: 15px;
  margin-top: 25px;
}

.btn {
  flex: 1;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
  padding: 16px 30px;
  border-radius: 12px;
  text-decoration: none;
  font-size: 1.05rem;
  font-weight: 600;
  transition: all 0.3s ease;
  cursor: pointer;
  border: none;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
  text-align: center;
}

.btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
}

.btn:active {
  transform: translateY(-1px);
}

.btn-secondary {
  background: #fff;
  color: #667eea;
  border: 2px solid #667eea;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
}

.btn-secondary:hover {
  background: #667eea;
  color: #fff;
}

.empty-cart {
  text-align: center;
  padding: 60px 20px;
  color: #666;
}

.empty-cart-icon {
  font-size: 5rem;
  margin-bottom: 20px;
  opacity: 0.3;
}

.empty-cart h3 {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: #333;
}

.empty-cart p {
  margin-bottom: 25px;
  font-size: 1rem;
}

    /* Responsive Navbar */
    .hamburger {
      display: none;
      cursor: pointer;
      flex-direction: column;
      gap: 5px;
      z-index: 1001;
    }

    .hamburger span {
      display: block;
      width: 25px;
      height: 3px;
      background: #111;
      border-radius: 2px;
      transition: all 0.3s;
    }

    .hamburger.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 6px);
    }

    .hamburger.active span:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
      transform: rotate(-45deg) translate(5px, -6px);
    }

    @media (max-width: 768px) {
      header {
        padding: 15px 20px;
        position: sticky;
      }

      .hamburger {
        display: flex;
        position: absolute;
        right: 20px;
        top: 25px;
      }

      nav {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #fff;
        flex-direction: column;
        align-items: center;
        padding: 20px 0;
        gap: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-150%);
        transition: transform 0.4s ease;
        z-index: 999;
        opacity: 0;
        pointer-events: none;
      }

      nav.active {
        display: flex;
        transform: translateY(0);
        opacity: 1;
        pointer-events: all;
      }

      header h1 {
        font-size: 1.5rem;
      }

      .checkout-container {
        margin: 30px 20px;
        padding: 25px 20px;
      }

      .checkout-title {
        font-size: 1.5rem;
      }

      .checkout-item {
        flex-direction: column;
        text-align: center;
      }

      .checkout-item img {
        margin-right: 0;
        margin-bottom: 15px;
      }

      .btn-container {
        flex-direction: column;
      }

      .summary-row.total {
        font-size: 1.2rem;
      }
    }

/* Loading animation */
.loading {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Dark Mode Overrides */
:is(.dark) body { background: #0f172a; color: #f1f5f9; }
:is(.dark) header { background: rgba(15, 23, 42, 0.9); border-bottom: 1px solid rgba(255,255,255,0.1); }
:is(.dark) .checkout-container { background: #1e293b; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); }
:is(.dark) .checkout-title { color: #f1f5f9; }
:is(.dark) .checkout-item { background: #334155; }
:is(.dark) .checkout-item:hover { box-shadow: 0 10px 25px rgba(0,0,0,0.3); }
:is(.dark) .item-name { color: #f1f5f9; }
:is(.dark) .item-price { color: #818cf8; }
:is(.dark) .summary-box { background: linear-gradient(135deg, #334155 0%, #1e293b 100%); }
:is(.dark) .summary-row { color: #cbd5e1; }
:is(.dark) .summary-row.total { color: #f1f5f9; border-top-color: #475569; }
:is(.dark) .btn-secondary { background: transparent; border-color: #818cf8; color: #818cf8; }
:is(.dark) .btn-secondary:hover { background: #818cf8; color: white; }
:is(.dark) .empty-cart { color: #94a3b8; }
:is(.dark) .empty-cart h3 { color: #f1f5f9; }
:is(.dark) .hamburger span { background: #f1f5f9; }
:is(.dark) nav { background: #1e293b; }
:is(.dark) .checkout-items-wrapper::-webkit-scrollbar-track { background: #334155; }
:is(.dark) nav a { color: #cbd5e1; }
:is(.dark) nav a:hover { color: #818cf8; }
</style>
</head>
<body>

<header>
  <h1>Nand Market</h1>
  <div class="hamburger" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav>
    <a href="{{route('produk')}}">Produk</a>
    <a href="{{route('beranda')}}">Beranda</a>
    <button onclick="window.toggleDarkMode()" class="p-2 ml-4 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Toggle Dark Mode">
      <svg class="w-6 h-6 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
      <svg class="w-6 h-6 block dark:hidden text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button>
  </nav>
</header>

<section class="checkout-container">
  <h2 class="checkout-title">Keranjang Belanja</h2>

  <div class="checkout-items-wrapper">
    <div id="checkout-items"></div>
  </div>

  <div id="summary-section"></div>

  <div class="btn-container">
    <button class="btn btn-secondary" onclick="continueShopping()">
      Lanjut Belanja
    </button>
    <button class="btn" onclick="proceedForm()" id="checkout-btn">
      Konfirmasi Pembelian
    </button>
  </div>
</section>

<script>
// Ambil data dari localStorage
const checkoutData = JSON.parse(localStorage.getItem('checkoutItem')) || JSON.parse(localStorage.getItem('cart')) || [];
const container = document.getElementById('checkout-items');
const summarySection = document.getElementById('summary-section');
let total = 0;

// Fungsi untuk menampilkan items
function displayItems() {
  if (checkoutData.length === 0) {
    container.innerHTML = `
      <div class="empty-cart">
        <div class="empty-cart-icon">🛒</div>
        <h3>Keranjang Kosong</h3>
        <p>Belum ada produk yang ditambahkan</p>
      </div>
    `;
    summarySection.style.display = 'none';
    document.querySelector('.btn-container').style.display = 'none';
    return;
  }

  checkoutData.forEach((item, index) => {
    const div = document.createElement('div');
    div.className = 'checkout-item';
    div.style.animationDelay = `${index * 0.1}s`;
    div.innerHTML = `
      <img src="${item.image}" alt="${item.name}">
      <div class="item-info">
        <p class="item-name">${item.name}</p>
        <p class="item-price">Rp ${item.price.toLocaleString('id-ID')}</p>
      </div>
    `;
    container.appendChild(div);
    total += parseFloat(item.price || 0);
  });

  // Tampilkan ringkasan
  const itemCount = checkoutData.length;
  const tax = total * 0.1; // PPN 10%
  const shipping = 15000; // Ongkir tetap
  const grandTotal = total + tax + shipping;

  summarySection.innerHTML = `
    <div class="summary-box">
      <div class="summary-row">
        <span>Subtotal (${itemCount} item)</span>
        <span>Rp ${total.toLocaleString('id-ID')}</span>
      </div>
      <div class="summary-row">
        <span>PPN (10%)</span>
        <span>Rp ${tax.toLocaleString('id-ID')}</span>
      </div>
      <div class="summary-row">
        <span>Ongkos Kirim</span>
        <span>Rp ${shipping.toLocaleString('id-ID')}</span>
      </div>
      <div class="summary-row total">
        <span>Total Pembayaran</span>
        <span>Rp ${grandTotal.toLocaleString('id-ID')}</span>
      </div>
    </div>
  `;
}

// Fungsi untuk lanjut belanja
function continueShopping() {
  window.location.href = '{{route("produk")}}';
}

// Fungsi untuk proses checkout
function proceedForm() {
  if (checkoutData.length === 0) {
    alert('Keranjang belanja Anda kosong!');
    return;
  }

  const btn = document.getElementById('checkout-btn');
  btn.innerHTML = '<span class="loading"></span> Memproses...';
  btn.disabled = true;

  setTimeout(() => {
    window.location.href = '{{route("form")}}';
  }, 800);
}

// Jalankan fungsi display
displayItems();

function toggleMenu() {
  const nav = document.querySelector('nav');
  const hamburger = document.querySelector('.hamburger');
  nav.classList.toggle('active');
  hamburger.classList.toggle('active');
}
</script>

</body>
</html>