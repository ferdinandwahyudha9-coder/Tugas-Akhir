<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya - Nand Second</title>
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
body { margin:0; font-family:'Poppins',sans-serif; background:#f5f5f5; color:#222; line-height:1.5; }
a { text-decoration:none; color:inherit; }

/* Header */
header {
  background:#fff;
  color:#111;
  padding:20px 50px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  position:sticky;
  top:0;
  border-bottom:1px solid #e0e0e0;
  z-index:1000;
  box-shadow:0 2px 8px rgba(0,0,0,0.05);
}
header h1 { font-size:1.8rem; font-weight:700; letter-spacing:1px; }
nav { display:flex; align-items:center; gap:25px; flex-wrap:wrap; }
nav a { font-weight:500; transition:0.3s; }
nav a:hover { color:#555; }

/* User Menu */
.user-menu {
  position: relative;
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  padding: 8px 15px;
  border-radius: 8px;
  transition: 0.3s;
}
.user-menu:hover {
  background: #f5f5f5;
}
.user-avatar {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 600;
  font-size: 0.9rem;
}
.user-name {
  font-weight: 600;
  font-size: 0.95rem;
}

/* Profile Container */
.profile-container {
  max-width: 1200px;
  margin: 40px auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: 280px 1fr;
  gap: 30px;
}

/* Sidebar */
.profile-sidebar {
  background: white;
  border-radius: 12px;
  padding: 25px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  height: fit-content;
  position: sticky;
  top: 100px;
}

.profile-header {
  text-align: center;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
  margin-bottom: 20px;
}

.profile-avatar-large {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-weight: 700;
  font-size: 2.5rem;
  margin: 0 auto 15px;
}

.profile-header h2 {
  font-size: 1.3rem;
  margin-bottom: 5px;
}

.profile-header p {
  color: #666;
  font-size: 0.9rem;
}

.profile-menu {
  list-style: none;
  padding: 0;
  margin: 0;
}

.profile-menu li {
  margin-bottom: 5px;
}

.profile-menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px 15px;
  border-radius: 8px;
  transition: 0.3s;
  font-size: 0.95rem;
}

.profile-menu a:hover {
  background: #f5f5f5;
}

.profile-menu a.active {
  background: #1e90ff;
  color: white;
  font-weight: 600;
}

.profile-menu a span {
  font-size: 1.2rem;
}

.logout-btn {
  width: 100%;
  padding: 12px;
  margin-top: 20px;
  border: none;
  background: #ff4444;
  color: white;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: 0.3s;
}

.logout-btn:hover {
  background: #cc0000;
}

/* Main Content */
.profile-content {
  background: white;
  border-radius: 12px;
  padding: 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  min-height: 500px;
}

.section {
  display: none;
}

.section.active {
  display: block;
}

.section h2 {
  font-size: 1.8rem;
  margin-bottom: 25px;
  color: #111;
}

/* Form Styles */
.form-group {
  margin-bottom: 20px;
}

.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  color: #333;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 0.95rem;
  font-family: inherit;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #1e90ff;
  box-shadow: 0 0 0 3px rgba(30,144,255,0.1);
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.btn-primary {
  padding: 12px 30px;
  background: #1e90ff;
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
  font-size: 0.95rem;
}

.btn-primary:hover {
  background: #00bfff;
  transform: translateY(-2px);
}

/* Info Cards */
.info-card {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 10px;
  margin-bottom: 20px;
}

.info-row {
  display: flex;
  justify-content: space-between;
  padding: 12px 0;
  border-bottom: 1px solid #e0e0e0;
}

.info-row:last-child {
  border-bottom: none;
}

.info-label {
  color: #666;
  font-weight: 500;
}

.info-value {
  color: #111;
  font-weight: 600;
}

/* Order History */
.order-card {
  border: 1px solid #e0e0e0;
  border-radius: 10px;
  padding: 20px;
  margin-bottom: 20px;
  transition: 0.3s;
}

.order-card:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #eee;
}

.order-id {
  font-weight: 700;
  color: #1e90ff;
  font-size: 1.1rem;
}

.order-status {
  padding: 6px 15px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
}

.status-pending {
  background: #fef3c7;
  color: #92400e;
}

.status-processing {
  background: #dbeafe;
  color: #1e40af;
}

.status-shipped {
  background: #e0e7ff;
  color: #3730a3;
}

.status-delivered {
  background: #d1fae5;
  color: #065f46;
}

.order-items {
  display: flex;
  gap: 15px;
  margin-bottom: 15px;
}

.order-item-img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 8px;
}

.order-item-details h4 {
  margin-bottom: 5px;
  font-size: 1rem;
}

.order-item-details p {
  color: #666;
  font-size: 0.9rem;
}

.order-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 15px;
  padding-top: 15px;
  border-top: 1px solid #eee;
}

.order-total {
  font-size: 1.1rem;
  font-weight: 700;
  color: #111;
}

.btn-secondary {
  padding: 8px 20px;
  background: white;
  color: #1e90ff;
  border: 2px solid #1e90ff;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}

.btn-secondary:hover {
  background: #1e90ff;
  color: white;
}

.empty-state {
  text-align: center;
  padding: 60px 20px;
  color: #999;
}

.empty-state-icon {
  font-size: 4rem;
  margin-bottom: 20px;
}

.empty-state h3 {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: #666;
}

.empty-state p {
  font-size: 1rem;
  margin-bottom: 20px;
}

/* Responsive */
@media(max-width:768px){
  header {
    flex-direction: column;
    padding: 15px 20px;
  }

  .profile-container {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .profile-sidebar {
    position: relative;
    top: 0;
  }

  .form-row {
    grid-template-columns: 1fr;
  }
}
</style>
</head>
<body>

<header>
  <h1><a href="{{route('beranda')}}">Nand Second</a></h1>
  <nav>
    <a href="{{route('produk')}}">Produk</a>
    <a href="{{route('beranda')}}">Beranda</a>
    <a href="{{route('beranda')}}#contact">Kontak</a>
    
    <button onclick="window.toggleDarkMode()" class="p-2 ml-4 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Toggle Dark Mode">
      <svg class="w-6 h-6 hidden dark:block text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
      <svg class="w-6 h-6 block dark:hidden text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button>
    <style>
      :is(.dark) body { background: #0f172a; color: #f1f5f9; }
      :is(.dark) header { background: #1e293b; color: #f1f5f9; border-bottom-color: #334155; }
      :is(.dark) header h1 a { color: #f1f5f9; }
      :is(.dark) nav a { color: #cbd5e1; }
      :is(.dark) nav a:hover { color: #f1f5f9; }
      :is(.dark) .user-menu:hover { background: #334155; }
      :is(.dark) .profile-sidebar, :is(.dark) .profile-content { background: #1e293b; color: #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.3); }
      :is(.dark) .profile-header { border-bottom-color: #334155; }
      :is(.dark) .profile-header p { color: #94a3b8; }
      :is(.dark) .profile-menu a { color: #cbd5e1; }
      :is(.dark) .profile-menu a:hover { background: #334155; color: #f1f5f9; }
      :is(.dark) .profile-menu a.active { background: #3b82f6; color: white; }
      :is(.dark) .section h2 { color: #f1f5f9; }
      :is(.dark) .form-group label { color: #cbd5e1; }
      :is(.dark) .form-group input, :is(.dark) .form-group textarea { background: #334155; border-color: #475569; color: #f1f5f9; }
      :is(.dark) .form-group input:disabled { background: #1e293b; color: #64748b; }
      :is(.dark) .info-card { background: #1e293b; border: 1px solid #334155; }
      :is(.dark) .info-row { border-bottom-color: #334155; }
      :is(.dark) .info-label { color: #94a3b8; }
      :is(.dark) .info-value { color: #f1f5f9; }
      :is(.dark) .order-card { border-color: #334155; background: #1e293b; }
      :is(.dark) .order-header, :is(.dark) .order-footer { border-color: #334155; }
      :is(.dark) .order-total { color: #f1f5f9; }
      :is(.dark) .order-item-details p { color: #94a3b8; }
      :is(.dark) .empty-state h3 { color: #f1f5f9; }
      :is(.dark) .empty-state p { color: #94a3b8; }
      :is(.dark) .btn-secondary { background: transparent; border-color: #3b82f6; color: #3b82f6; }
      :is(.dark) .btn-secondary:hover { background: #3b82f6; color: white; }
    </style>

    <a href="{{route('keranjang')}}">🛒 Keranjang</a>
    <div class="user-menu" onclick="window.location.href='{{ route('profil') }}'">
      <div class="user-avatar" id="headerAvatar">{{ substr($user->name, 0, 1) }}</div>
      <span class="user-name" id="headerName">{{ explode(' ', $user->name)[0] }}</span>
    </div>
  </nav>
</header>

<div class="profile-container">
  <!-- Sidebar -->
  <aside class="profile-sidebar">
    <div class="profile-header">
      <div class="profile-avatar-large" id="sidebarAvatar">{{ substr($user->name, 0, 1) }}</div>
      <h2 id="sidebarName">{{ $user->name }}</h2>
      <p id="sidebarEmail">{{ $user->email }}</p>
    </div>

    <ul class="profile-menu">
      <li><a href="#" class="active" data-section="account" onclick="showSection('account')"><span>👤</span> Akun Saya</a></li>
      <li><a href="#" data-section="orders" onclick="showSection('orders')"><span>📦</span> Pesanan Saya</a></li>
      <li><a href="#" data-section="address" onclick="showSection('address')"><span>📍</span> Alamat</a></li>
      <li><a href="#" data-section="password" onclick="showSection('password')"><span>🔒</span> Ganti Password</a></li>
    </ul>

    <button class="logout-btn" onclick="logout()">🚪 Logout</button>
  </aside>

  <!-- Main Content -->
  <main class="profile-content">

    <!-- Account Section -->
    <section id="account" class="section active">
      <h2>Informasi Akun</h2>

      <div class="info-card">
        <div class="info-row">
          <span class="info-label">Nama Lengkap</span>
          <span class="info-value" id="displayName">-</span>
        </div>
        <div class="info-row">
          <span class="info-label">Email</span>
          <span class="info-value" id="displayEmail">-</span>
        </div>
        <div class="info-row">
          <span class="info-label">No. Telepon</span>
          <span class="info-value" id="displayPhone">Belum diisi</span>
        </div>
        <div class="info-row">
          <span class="info-label">Bergabung Sejak</span>
          <span class="info-value" id="displayJoined">-</span>
        </div>
      </div>

      <h3 style="margin-top: 30px; margin-bottom: 20px;">Edit Profil</h3>

      <form onsubmit="updateProfile(event)">
        <div class="form-row">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" id="editName" required>
          </div>
          <div class="form-group">
            <label>No. Telepon</label>
            <input type="tel" id="editPhone" placeholder="08xxxxxxxxxx">
          </div>
        </div>

        <div class="form-group">
          <label>Email</label>
          <input type="email" id="editEmail" disabled style="background: #f5f5f5; cursor: not-allowed;">
        </div>

        <button type="submit" class="btn-primary">💾 Simpan Perubahan</button>
      </form>
    </section>

    <!-- Orders Section -->
    <section id="orders" class="section">
      <h2>Riwayat Pesanan</h2>

      <div id="ordersContainer">
        <!-- Orders akan dimuat di sini -->
      </div>
    </section>

    <!-- Address Section -->
    <section id="address" class="section">
      <h2>Alamat Pengiriman</h2>

      <form onsubmit="updateAddress(event)">
        <div class="form-group">
          <label>Alamat Lengkap</label>
          <textarea id="editAddress" rows="3" placeholder="Jl. Contoh No. 123"></textarea>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Kota</label>
            <input type="text" id="editCity" placeholder="Jakarta">
          </div>
          <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" id="editPostalCode" placeholder="12345">
          </div>
        </div>

        <button type="submit" class="btn-primary">💾 Simpan Alamat</button>
      </form>
    </section>

    <!-- Password Section -->
    <section id="password" class="section">
      <h2>Ganti Password</h2>

      <form onsubmit="changePassword(event)">
        <div class="form-group">
          <label>Password Lama</label>
          <input type="password" id="oldPassword" required>
        </div>

        <div class="form-group">
          <label>Password Baru</label>
          <input type="password" id="newPassword" required minlength="6">
        </div>

        <div class="form-group">
          <label>Konfirmasi Password Baru</label>
          <input type="password" id="confirmPassword" required minlength="6">
        </div>

        <button type="submit" class="btn-primary">🔒 Ubah Password</button>
      </form>
    </section>

  </main>
</div>

<script>
// Data user dari Laravel (bukan localStorage)
let currentUser = {
  name: "{{ $user->name }}",
  email: "{{ $user->email }}",
  phone: "{{ $user->phone ?? '' }}",
  address: "{{ $user->address ?? '' }}",
  city: "{{ $user->city ?? '' }}",
  postalCode: "{{ $user->postal_code ?? '' }}",
  createdAt: "{{ $user->created_at }}"
};

// Load user data
function loadUserData(){
  // Update header
  const initial = currentUser.name.charAt(0).toUpperCase();
  document.getElementById('headerAvatar').textContent = initial;
  document.getElementById('headerName').textContent = currentUser.name.split(' ')[0];

  // Update sidebar
  document.getElementById('sidebarAvatar').textContent = initial;
  document.getElementById('sidebarName').textContent = currentUser.name;
  document.getElementById('sidebarEmail').textContent = currentUser.email;

  // Update account info
  document.getElementById('displayName').textContent = currentUser.name;
  document.getElementById('displayEmail').textContent = currentUser.email;
  document.getElementById('displayPhone').textContent = currentUser.phone || 'Belum diisi';

  const joinedDate = new Date(currentUser.createdAt).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  });
  document.getElementById('displayJoined').textContent = joinedDate;

  // Populate edit forms
  document.getElementById('editName').value = currentUser.name;
  document.getElementById('editEmail').value = currentUser.email;
  document.getElementById('editPhone').value = currentUser.phone || '';
  document.getElementById('editAddress').value = currentUser.address || '';
  document.getElementById('editCity').value = currentUser.city || '';
  document.getElementById('editPostalCode').value = currentUser.postalCode || '';

  // Load orders
  loadOrders();
}

// Show section
function showSection(sectionName){
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.getElementById(sectionName).classList.add('active');
  document.querySelectorAll('.profile-menu a').forEach(a => a.classList.remove('active'));
  document.querySelector(`[data-section="${sectionName}"]`).classList.add('active');
  return false;
}

// Update profile - Kirim ke server Laravel
function updateProfile(e){
  e.preventDefault();
  alert('Fitur update profil akan segera tersedia!');
  // TODO: Implement AJAX request ke Laravel
}

// Update address
function updateAddress(e){
  e.preventDefault();
  alert('Fitur update alamat akan segera tersedia!');
  // TODO: Implement AJAX request ke Laravel
}

// Change password
function changePassword(e){
  e.preventDefault();
  alert('Fitur ganti password akan segera tersedia!');
  // TODO: Implement AJAX request ke Laravel
}

// Load orders
function loadOrders(){
  const ordersContainer = document.getElementById('ordersContainer');
  ordersContainer.innerHTML = `
    <div class="empty-state">
      <div class="empty-state-icon">📦</div>
      <h3>Belum Ada Pesanan</h3>
      <p>Anda belum melakukan pemesanan apapun</p>
      <button class="btn-primary" onclick="window.location.href='{{route('produk')}}'">🛍️ Mulai Belanja</button>
    </div>
  `;
}

function viewOrderDetail(orderId){
  alert('Detail pesanan ' + orderId);
}

// Logout - Kirim ke Laravel
function logout(){
  if(confirm('Yakin ingin logout?')){
    // Submit form logout ke Laravel
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{route("auth.logout")}}';
    
    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = '{{ csrf_token() }}';
    form.appendChild(csrf);
    
    document.body.appendChild(form);
    form.submit();
  }
}

// Load data on page load
loadUserData();
</script>

</body>
</html>
