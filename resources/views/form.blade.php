<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pembayaran - Nand Second</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
  letter-spacing: 0.5px;
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

.container {
  max-width: 1100px;
  margin: 50px auto;
  background: #fff;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  display: flex;
  flex-wrap: wrap;
  gap: 50px;
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

.form-section,
.summary-section {
  flex: 1 1 450px;
}

.section-title {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 25px;
  color: #111;
  position: relative;
  padding-bottom: 15px;
}

.section-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 70px;
  height: 4px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 2px;
}

.form-group {
  margin-bottom: 20px;
  animation: slideInLeft 0.5s ease forwards;
  opacity: 0;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group:nth-child(5) { animation-delay: 0.5s; }
.form-group:nth-child(6) { animation-delay: 0.6s; }

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  color: #333;
  font-size: 0.95rem;
}

input,
select,
textarea {
  width: 100%;
  padding: 14px 16px;
  border-radius: 10px;
  border: 2px solid #e0e0e0;
  font-size: 1rem;
  font-family: 'Poppins', sans-serif;
  transition: all 0.3s ease;
  background: #f9f9f9;
}

input:focus,
select:focus,
textarea:focus {
  outline: none;
  border-color: #667eea;
  background: #fff;
  box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

textarea {
  resize: vertical;
  min-height: 100px;
}

.summary-section {
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  padding: 30px;
  border-radius: 15px;
  height: fit-content;
  position: sticky;
  top: 120px;
}

.items-list {
  margin-bottom: 25px;
}

.item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  animation: fadeIn 0.5s ease forwards;
  opacity: 0;
}

@keyframes fadeIn {
  to {
    opacity: 1;
  }
}

.item:last-child {
  border-bottom: none;
}

.item-name {
  font-weight: 500;
  color: #333;
}

.item-price {
  font-weight: 600;
  color: #667eea;
}

.summary-divider {
  height: 2px;
  background: linear-gradient(90deg, transparent, rgba(0,0,0,0.1), transparent);
  margin: 20px 0;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 12px;
  font-size: 1rem;
  color: #555;
}

.total-row {
  display: flex;
  justify-content: space-between;
  font-weight: 700;
  font-size: 1.5rem;
  color: #111;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 2px solid rgba(0, 0, 0, 0.15);
}

.btn {
  width: 100%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
  padding: 16px 30px;
  border-radius: 12px;
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  border: none;
  box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
  margin-top: 25px;
  display: block;
  text-align: center;
}

.btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
}

.btn:active {
  transform: translateY(-1px);
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

.back-link {
  display: block;
  margin-top: 20px;
  text-decoration: none;
  color: #667eea;
  font-weight: 500;
  text-align: center;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.back-link:hover {
  color: #764ba2;
  transform: translateX(-5px);
}

.loading {
  display: inline-block;
  width: 18px;
  height: 18px;
  border: 3px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 0.8s linear infinite;
  margin-right: 8px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.empty-cart {
  text-align: center;
  padding: 60px 20px;
  color: #666;
}

.empty-cart-icon {
  font-size: 4rem;
  margin-bottom: 20px;
  opacity: 0.3;
}

.empty-cart h3 {
  font-size: 1.3rem;
  margin-bottom: 10px;
  color: #333;
}

.input-icon {
  position: relative;
}

.input-icon input {
  padding-left: 45px;
}

.icon {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.2rem;
  color: #999;
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

      .container {
        margin: 30px 20px;
        padding: 25px 20px;
        gap: 30px;
      }

      .section-title {
        font-size: 1.5rem;
      }

      .summary-section {
        position: static;
      }

      .total-row {
        font-size: 1.3rem;
      }
    }

/* Dark Mode Overrides */
:is(.dark) body { background: #0f172a; color: #f1f5f9; }
:is(.dark) header { background: rgba(15, 23, 42, 0.9); border-bottom: 1px solid rgba(255,255,255,0.1); }
:is(.dark) .container { background: #1e293b; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); }
:is(.dark) .section-title { color: #f1f5f9; }
:is(.dark) label { color: #cbd5e1; }
:is(.dark) input, 
:is(.dark) textarea { background: #334155; border-color: #475569; color: #f1f5f9; }
:is(.dark) input:focus, 
:is(.dark) textarea:focus { background: #1e293b; border-color: #818cf8; }
:is(.dark) .summary-section { background: linear-gradient(135deg, #334155 0%, #1e293b 100%); }
:is(.dark) .summary-row { color: #cbd5e1; }
:is(.dark) .item { border-bottom-color: #475569; }
:is(.dark) .item-name { color: #f1f5f9; }
:is(.dark) .item-price { color: #818cf8; }
:is(.dark) .total-row { color: #f1f5f9; border-top-color: #475569; }
:is(.dark) .back-link { color: #818cf8; }
:is(.dark) .back-link:hover { color: #a5b4fc; }
:is(.dark) .hamburger span { background: #f1f5f9; }
:is(.dark) nav { background: #1e293b; }
:is(.dark) nav a { color: #cbd5e1; }
:is(.dark) nav a:hover { color: #818cf8; }
:is(.dark) .empty-cart { color: #94a3b8; }
:is(.dark) .empty-cart h3 { color: #f1f5f9; }
</style>
</head>
<body>

<header>
  <h1>Nand Second</h1>
  <div class="hamburger" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav>
    <a href="{{route('beranda')}}">Beranda</a>
    <a href="{{route('produk')}}">Produk</a>
    <a href="{{route('keranjang')}}">Keranjang</a>
    <button onclick="window.toggleDarkMode()" class="p-2 ml-4 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Toggle Dark Mode">
      <svg class="w-6 h-6 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
      <svg class="w-6 h-6 block dark:hidden text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button>
  </nav>
</header>

<div class="container">
  <div class="form-section">
    <h2 class="section-title">Alamat Pengiriman</h2>

    <div class="form-group">
      <label for="nama">📝 Nama Lengkap</label>
      <input type="text" id="nama" placeholder="Masukkan nama lengkap Anda" required>
    </div>

    <div class="form-group">
      <label for="email">📧 Email</label>
      <input type="email" id="email" placeholder="contoh@email.com" required>
    </div>

    <div class="form-group">
      <label for="telp">📱 Nomor Telepon</label>
      <input type="tel" id="telp" placeholder="08xxxxxxxxxx" required>
    </div>

    <div class="form-group">
      <label for="alamat">📍 Alamat Lengkap</label>
      <textarea id="alamat" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" rows="4" required></textarea>
    </div>

    <div class="form-group">
      <label for="kota">🏙️ Kota / Kabupaten</label>
      <input type="text" id="kota" placeholder="Nama kota atau kabupaten" required>
    </div>

    <div class="form-group">
      <label for="kodepos">📮 Kode Pos</label>
      <input type="text" id="kodepos" placeholder="12345" maxlength="5" required>
    </div>
  </div>

  <div class="summary-section">
    <h2 class="section-title">Ringkasan Pesanan</h2>

    <div class="items-list" id="itemsContainer"></div>

    <div class="summary-divider"></div>

    <div id="summaryDetails"></div>

    <div class="total-row" id="totalHarga"></div>

    <button class="btn" id="bayarBtn">
      💳 Bayar Sekarang
    </button>

    <a href="{{route('produk')}}" class="back-link">← Kembali ke Produk</a>
  </div>
</div>

<script>
// Ambil item checkout dari localStorage
let checkoutItem = JSON.parse(localStorage.getItem('checkoutItem')) || [];
if (checkoutItem.length === 0) {
  checkoutItem = JSON.parse(localStorage.getItem('cart')) || [];
}

const itemsContainer = document.getElementById('itemsContainer');
const summaryDetails = document.getElementById('summaryDetails');
const totalHarga = document.getElementById('totalHarga');
let subtotal = 0;
let total = 0;

// Jika keranjang kosong
if (checkoutItem.length === 0) {
  itemsContainer.innerHTML = `
    <div class="empty-cart">
      <div class="empty-cart-icon">🛒</div>
      <h3>Keranjang Kosong</h3>
      <p>Belum ada produk yang dipilih</p>
    </div>
  `;
  document.getElementById('bayarBtn').disabled = true;
  document.getElementById('bayarBtn').textContent = 'Keranjang Kosong';
} else {
  // Tampilkan items
  checkoutItem.forEach((item, index) => {
    const qty = item.qty || 1;
    const itemTotal = parseFloat(item.price || 0) * qty;
    subtotal += itemTotal;

    const div = document.createElement('div');
    div.className = 'item';
    div.style.animationDelay = `${index * 0.1}s`;
    div.innerHTML = `
      <span class="item-name">${item.name} <small>x${qty}</small></span>
      <span class="item-price">Rp ${itemTotal.toLocaleString('id-ID')}</span>
    `;
    itemsContainer.appendChild(div);
  });

  // Hitung biaya tambahan
  const tax = subtotal * 0.1; // PPN 10%
  const shipping = 15000; // Ongkir
  total = subtotal + tax + shipping;

  // Tampilkan detail biaya
  summaryDetails.innerHTML = `
    <div class="summary-row">
      <span>Subtotal</span>
      <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
    </div>
    <div class="summary-row">
      <span>PPN (10%)</span>
      <span>Rp ${tax.toLocaleString('id-ID')}</span>
    </div>
    <div class="summary-row">
      <span>Ongkos Kirim</span>
      <span>Rp ${shipping.toLocaleString('id-ID')}</span>
    </div>
  `;

  totalHarga.innerHTML = `
    <span>Total Pembayaran</span>
    <span>Rp ${total.toLocaleString('id-ID')}</span>
  `;

  // Tombol bayar - KIRIM KE SERVER
  document.getElementById('bayarBtn').onclick = async (e) => {
    e.preventDefault();

    const nama = document.getElementById('nama').value.trim();
    const email = document.getElementById('email').value.trim();
    const telp = document.getElementById('telp').value.trim();
    const alamat = document.getElementById('alamat').value.trim();
    const kota = document.getElementById('kota').value.trim();
    const kodepos = document.getElementById('kodepos').value.trim();

    // Validasi form
    if (!nama || !email || !telp || !alamat || !kota || !kodepos) {
      alert("⚠️ Mohon lengkapi semua data alamat pengiriman!");
      return;
    }

    // Validasi email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("⚠️ Format email tidak valid!");
      return;
    }

    // Validasi telepon
    if (telp.length < 10) {
      alert("⚠️ Nomor telepon minimal 10 digit!");
      return;
    }

    if (kodepos.length !== 5) {
      alert("⚠️ Kode pos harus 5 digit!");
      return;
    }

    // Safety check: Pastikan semua item memiliki ID
    const hasCorruptItems = checkoutItem.some(item => !item.id);
    if (hasCorruptItems) {
        alert("⚠️ Ada masalah dengan data di keranjang Anda. Silakan kembali ke keranjang untuk memperbarui data.");
        window.location.href = '{{ route("keranjang") }}';
        return;
    }

    // Cek CSRF token
    const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenElement || !csrfTokenElement.content) {
      alert("⚠️ Session expired. Silakan refresh halaman dan coba lagi.");
      window.location.reload();
      return;
    }

    // Loading state
    const btn = document.getElementById('bayarBtn');
    btn.innerHTML = '<span class="loading"></span> Memproses Pembayaran...';
    btn.disabled = true;

    // KIRIM DATA KE SERVER
    try {
      const response = await fetch('{{ route("checkout.process") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfTokenElement.content,
          'Accept': 'application/json'
        },
        body: JSON.stringify({
          nama: nama,
          email: email,
          telp: telp,
          alamat: alamat,
          kota: kota,
          kodepos: kodepos,
          items: checkoutItem.map(item => ({ ...item, qty: item.qty || 1 })),
          total: total
        })
      });

      // Handle berbagai jenis error
      if (response.status === 401 || response.status === 419) {
        // 401 Unauthorized atau 419 CSRF Token Mismatch
        alert("⚠️ Sesi Anda telah berakhir. Halaman akan dimuat ulang untuk memperbarui sesi.");
        window.location.reload();
        return;
      }

      const result = await response.json();

      if (response.ok && result.success) {
        alert(`✅ Terima kasih ${nama}!\n\nPesanan Anda sebesar Rp ${total.toLocaleString('id-ID')} berhasil diproses.\n\nDetail pesanan akan dikirim ke ${email}.`);

        // Bersihkan localStorage
        localStorage.removeItem('checkoutItem');
        localStorage.removeItem('cart');

        // Redirect ke halaman produk
        window.location.href = '{{route("produk")}}';
      } else {
        // Tampilkan pesan error dengan detail
        let errorMessage = result.message || 'Unknown error';
        if (result.errors) {
          errorMessage += '\n\nDetail:\n' + Object.values(result.errors).flat().join('\n');
        }
        alert('❌ Terjadi kesalahan: ' + errorMessage);
        btn.innerHTML = '💳 Bayar Sekarang';
        btn.disabled = false;
      }
    } catch (error) {
      console.error('Error:', error);
      alert('❌ Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.\n\nJika masalah berlanjut, silakan refresh halaman.');
      btn.innerHTML = '💳 Bayar Sekarang';
      btn.disabled = false;
    }
  };
}

function toggleMenu() {
  const nav = document.querySelector('nav');
  const hamburger = document.querySelector('.hamburger');
  nav.classList.toggle('active');
  hamburger.classList.toggle('active');
}
</script>

</body>
</html>
