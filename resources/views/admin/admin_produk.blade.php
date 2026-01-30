@extends('layouts.admin')

@section('title', 'Produk')

@section('header')
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">📦 Product Management</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola semua produk di katalog Anda</p>
    </div>
@endsection

@section('actions')
    <button onclick="openModal('add')" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-medium shadow-sm transition text-sm flex items-center gap-2">
        ➕ Tambah Produk Baru
    </button>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-blue-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-xl">📦</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Total Produk</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $products->total() }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-green-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-xl">✅</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Stok Tersedia</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $products->sum('stok') }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-yellow-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center text-xl">⚠️</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Stok Menipis</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $products->where('stok', '<', 10)->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4 flex-wrap">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" id="searchInput" onkeyup="searchProducts()" placeholder="Cari nama produk atau ID..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-shadow dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
            </div>
            
            <select id="categoryFilter" onchange="filterByCategory()" 
                class="w-full md:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white dark:bg-gray-700 dark:text-white">
                <option value="">Semua Kategori</option>
                <option value="Kaos">Kaos</option>
                <option value="Jaket">Jaket</option>
                <option value="Aksesoris">Aksesoris</option>
            </select>
            
            <select id="stockFilter" onchange="filterByStock()" 
                class="w-full md:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white dark:bg-gray-700 dark:text-white">
                <option value="">Semua Stok</option>
                <option value="high">Stok Tinggi (>20)</option>
                <option value="medium">Stok Sedang (10-20)</option>
                <option value="low">Stok Rendah (<10)</option>
            </select>
            
            <div class="flex bg-gray-100 dark:bg-gray-700 p-1 rounded-lg border border-gray-200 dark:border-gray-600">
                <button onclick="toggleView('grid')" class="view-btn active px-3 py-1.5 rounded-md text-sm font-medium transition-all text-white bg-blue-600 shadow-sm">🔲 Grid</button>
                <button onclick="toggleView('table')" class="view-btn px-3 py-1.5 rounded-md text-sm font-medium transition-all text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">📋 Table</button>
            </div>
            
            <button onclick="resetFilters()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition text-sm flex items-center gap-2">
                🔄 Reset
            </button>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300 group hover:-translate-y-1 border border-gray-100 dark:border-gray-700">
                <div class="h-48 overflow-hidden bg-gray-100 dark:bg-gray-700">
                    <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/'.$product->image) : asset('images/'.$product->image) }}" 
                        alt="{{ $product->nama }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-5">
                    <h3 class="font-semibold text-gray-800 dark:text-white mb-1 truncate">{{ $product->nama }}</h3>
                    <div class="text-lg font-bold text-green-600 mb-3">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    
                    <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mb-4">
                        <span class="flex items-center gap-1">📦 Stok: {{ $product->stok }}</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-gray-600 dark:text-gray-300">🏷️ {{ $product->label ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex gap-2">
                        <button onclick="editProduct({{ $product->id }})" class="flex-1 py-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 font-medium text-xs transition-colors">✏️ Edit</button>
                        <button onclick="deleteProduct({{ $product->id }})" class="flex-1 py-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 font-medium text-xs transition-colors">🗑️ Hapus</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-gray-500 text-lg">Belum ada produk. Klik "Tambah Produk Baru" untuk menambah.</p>
            </div>
        @endforelse
    </div>

    <!-- Table View -->
    <div id="tableView" class="hidden bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 uppercase text-xs font-semibold border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Foto</th>
                        <th class="p-4">Nama Produk</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Ukuran</th>
                        <th class="p-4">Label</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 dark:text-gray-300 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="p-4 font-mono text-xs">#{{ $product->id }}</td>
                            <td class="p-4">
                                <img src="{{ Str::startsWith($product->image, 'products/') ? asset('storage/'.$product->image) : asset('images/'.$product->image) }}" 
                                    class="w-12 h-12 rounded object-cover border border-gray-200 dark:border-gray-600" alt="{{ $product->nama }}">
                            </td>
                            <td class="p-4 font-medium">{{ $product->nama }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $product->stok > 20 ? 'bg-green-100 text-green-800' : ($product->stok > 10 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stok }} pcs
                                </span>
                            </td>
                            <td class="p-4">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                             <td class="p-4 text-gray-500 dark:text-gray-400">{{ $product->category ?? '-' }}</td>
                             <td class="p-4 text-gray-500 dark:text-gray-400">{{ $product->size ?? '-' }}</td>
                            <td class="p-4 text-gray-500 dark:text-gray-400">{{ $product->label ?? '-' }}</td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <button onclick="editProduct({{ $product->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition">✏️</button>
                                    <button onclick="deleteProduct({{ $product->id }})" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-500">Belum ada produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="productModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal()"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-white" id="modalTitle">➕ Tambah Produk Baru</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>
                    
                    <form id="productForm">
                        @csrf
                        <input type="hidden" id="productId" name="id">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload Foto Produk</label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-blue-500 dark:hover:border-blue-500 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors" onclick="document.getElementById('imageInput').click()">
                                <input type="file" id="imageInput" name="image" accept="image/*" onchange="previewImage(event)" class="hidden">
                                <div class="text-sm text-gray-600 dark:text-gray-400">📷 Klik untuk upload gambar utama</div>
                                <img id="imagePreview" class="mt-3 mx-auto max-h-48 rounded hidden">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Galeri Foto Tambahan (Maks 5)</label>
                            <input type="file" id="galleryInput" name="gallery[]" accept="image/*" multiple 
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:text-gray-400">
                            <p class="text-xs text-gray-500 mt-1">* Anda bisa memilih beberapa file sekaligus</p>
                            <div id="galleryPreview" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Produk</label>
                            <input type="text" id="productName" name="nama" placeholder="Masukkan nama produk" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                                <select id="productCategory" name="category" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Kaos">Kaos</option>
                                    <option value="Jaket">Jaket</option>
                                    <option value="Celana">Celana</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ukuran</label>
                                <select id="productSize" name="size" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Ukuran</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="All">All Size</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga (Rp)</label>
                                <input type="number" id="productPrice" name="harga" placeholder="0" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                                <input type="number" id="productStock" name="stok" placeholder="0" required
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Label (Opsional)</label>
                            <input type="text" id="productLabel" name="label" placeholder="Contoh: New Arrival"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                            <textarea id="productDescription" name="deskripsi" rows="3" placeholder="Masukkan deskripsi produk"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"></textarea>
                        </div>
                        
                        <div class="flex gap-3 justify-end">
                            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition text-sm">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition text-sm shadow-sm">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleView(view) {
        const gridBtn = document.querySelector('button[onclick="toggleView(\'grid\')"]');
        const tableBtn = document.querySelector('button[onclick="toggleView(\'table\')"]');
        const gridView = document.getElementById('gridView');
        const tableView = document.getElementById('tableView');

        if (view === 'grid') {
            gridView.classList.remove('hidden');
            gridView.classList.add('grid');
            tableView.classList.add('hidden');
            
            gridBtn.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
            gridBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
            
            tableBtn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
            tableBtn.classList.add('text-gray-600', 'hover:text-gray-900');
        } else {
            gridView.classList.add('hidden');
            gridView.classList.remove('grid');
            tableView.classList.remove('hidden');
            
            tableBtn.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
            tableBtn.classList.remove('text-gray-600', 'hover:text-gray-900');
            
            gridBtn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
            gridBtn.classList.add('text-gray-600', 'hover:text-gray-900');
        }
    }

    // Modal Functions
    const modal = document.getElementById('productModal');
    
    function openModal(type, id = null) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        if (type === 'add') {
            document.getElementById('modalTitle').innerText = '➕ Tambah Produk Baru';
            document.getElementById('productForm').reset();
            document.getElementById('imagePreview').style.display = 'none';
        } else {
            document.getElementById('modalTitle').innerText = '✏️ Edit Produk';
            // Logic to fetch/fill data goes here
        }
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    // modal.addEventListener('click', function(e) {
    //    if (e.target === modal) {
    //        closeModal();
    //    }
    // });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
            output.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Gallery Preview handling
    document.getElementById('galleryInput').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('galleryPreview');
        previewContainer.innerHTML = '';
        
        if (this.files) {
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-16 h-16 object-cover rounded border border-gray-200 dark:border-gray-600';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    });

    // Search & Filter Placeholders
    function searchProducts() {
        // Implement search logic
        console.log('Searching...');
    }

    function filterByCategory() {
        console.log('Filtering by category...');
    }

    function filterByStock() {
        console.log('Filtering by stock...');
    }

    function resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('categoryFilter').value = '';
        document.getElementById('stockFilter').value = '';
        console.log('Filters reset');
    }

    function deleteProduct(id) {
        if(!confirm('Apakah Anda yakin ingin menghapus produk ini?')) return;
        
        fetch(`/admin/produk/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('✅ Produk berhasil dihapus!');
                location.reload();
            } else {
                alert('❌ Gagal: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('❌ Terjadi kesalahan fatal');
        });
    }

    // Modal logic for Edit
    function editProduct(id) {
        openModal('edit', id);
        fetch(`/admin/produk/${id}`, {
            headers: { 'Accept': 'application/json' }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('productId').value = data.id;
            document.getElementById('productName').value = data.nama;
            document.getElementById('productCategory').value = data.category || '';
            document.getElementById('productSize').value = data.size || '';
            document.getElementById('productPrice').value = data.harga;
            document.getElementById('productStock').value = data.stok;
            document.getElementById('productLabel').value = data.label || '';
            document.getElementById('productDescription').value = data.deskripsi || '';
            if (data.image) {
                const preview = document.getElementById('imagePreview');
                preview.src = data.image.startsWith('products/') ? `/storage/${data.image}` : `/images/${data.image}`;
                preview.style.display = 'block';
                preview.classList.remove('hidden');
            }

            // Preview existing Gallery
            const galleryPreview = document.getElementById('galleryPreview');
            galleryPreview.innerHTML = '';
            if (data.images && data.images.length > 0) {
                data.images.forEach(imgData => {
                    const img = document.createElement('img');
                    img.src = `/storage/${imgData.image}`;
                    img.className = 'w-16 h-16 object-cover rounded border border-gray-200 dark:border-gray-600';
                    galleryPreview.appendChild(img);
                });
            }
        });
    }

    // Update form submission
    document.getElementById('productForm').onsubmit = function(e) {
        e.preventDefault();
        const id = document.getElementById('productId').value;
        const formData = new FormData(this);
        
        const url = id ? `/admin/produk/${id}` : '/admin/produk';
        if (id) formData.append('_method', 'PUT');

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert(id ? '✅ Produk berhasil diupdate!' : '✅ Produk berhasil ditambahkan!');
                location.reload();
            } else {
                alert('❌ Error: ' + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert('❌ Terjadi kesalahan saat menyimpan');
        });
    };
</script>
@endpush
