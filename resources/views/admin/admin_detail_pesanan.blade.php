@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('header')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                📋 <span class="font-mono">{{ $order->order_number }}</span>
            </h1>
            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1 flex flex-wrap gap-2">
                <span>Order dari: <span class="font-medium text-gray-700 dark:text-gray-300">{{ $order->user->name ?? 'Guest' }}</span></span>
                <span class="hidden md:inline">•</span>
                <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <button onclick="location.href='{{ route('admin.pesanan') }}'" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition text-sm flex items-center gap-2 shadow-sm w-fit">
            ← Kembali
        </button>
    </div>
@endsection

@section('content')
    <!-- Status Update Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
            🛠️ Update Status & Notifikasi
        </h3>
        <div class="flex flex-col xl:flex-row gap-4 items-start xl:items-end bg-gray-50 dark:bg-gray-700/50 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
            <div class="w-full xl:w-auto flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status Pesanan</label>
                    <select id="statusSelect" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white dark:bg-gray-700 dark:text-white">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Email Customer</label>
                    <input id="contactEmail" type="email" value="{{ $order->user->email ?? '' }}" placeholder="Email (optional)"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">No. WhatsApp</label>
                    <input id="contactPhone" type="text" value="{{ $order->user->phone ?? '' }}" placeholder="Phone (optional)" onblur="formatPhoneInput()"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-sm dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                </div>

                <div class="flex flex-col justify-end h-full pt-6">
                    <div class="flex gap-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="notifyEmail" checked class="rounded border-gray-300 dark:border-gray-600 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">Email</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="notifyWhatsapp" class="rounded border-gray-300 dark:border-gray-600 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 dark:bg-gray-700">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">WhatsApp</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <button onclick="updateStatus({{ $order->id }})" class="w-full xl:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition text-sm shadow-sm flex items-center justify-center gap-2">
                💬 Kirim Notifikasi
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-blue-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-xl">📦</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Total Items</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $order->details->sum('quantity') }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-green-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-xl">💳</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Total Harga</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-yellow-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center text-xl">📊</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Status</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ ucfirst($order->status) }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-purple-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center text-xl">👤</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Customer</div>
                <div class="text-lg font-bold text-gray-800 dark:text-white truncate" title="{{ $order->user->name ?? 'Guest' }}">
                    {{ substr($order->user->name ?? 'Guest', 0, 15) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                👤 Informasi Customer
            </h3>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div class="flex justify-between py-3">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Nama</span>
                    <span class="font-medium text-gray-800 dark:text-white text-sm">{{ $order->user->name ?? 'Guest' }}</span>
                </div>
                <div class="flex justify-between py-3">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Email</span>
                    <span class="font-medium text-gray-800 dark:text-white text-sm">{{ $order->user->email ?? '-' }}</span>
                </div>
                <div class="flex justify-between py-3">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Tanggal Order</span>
                    <span class="font-medium text-gray-800 dark:text-white text-sm">{{ $order->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                📋 Ringkasan Pembayaran
            </h3>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <div class="flex justify-between py-3">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Subtotal</span>
                    <span class="font-medium text-gray-800 dark:text-white text-sm">Rp {{ number_format($order->details->sum(fn($d) => $d->subtotal), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-3">
                    <span class="text-gray-500 dark:text-gray-400 text-sm">Status</span>
                    <span class="font-bold text-green-600 dark:text-green-400 text-sm">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="flex justify-between py-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-2">
                    <span class="text-gray-800 dark:text-white font-bold">Total</span>
                    <span class="text-gray-900 dark:text-white font-bold text-lg">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Table Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden mb-8">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="w-full md:w-auto flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari produk..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-shadow dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
            </div>
            
            <div class="flex gap-2 w-full md:w-auto">
                {{-- <button onclick="openModal('add')" class="flex-1 md:flex-none px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-medium shadow-sm transition text-sm flex items-center justify-center gap-2">
                    ➕ Tambah Item
                </button> --}}
                <button onclick="exportData()" class="flex-1 md:flex-none px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition text-sm flex items-center justify-center gap-2">
                    📥 Print Struk
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="detailsTable" class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 uppercase text-xs font-semibold border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="p-4">Detail ID</th>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Subtotal</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 dark:text-gray-300 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($order->details as $detail)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="p-4 text-gray-500 font-mono text-xs">#{{ $detail->id }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 overflow-hidden border border-gray-200 dark:border-gray-600 shrink-0">
                                        <img src="{{ $detail->product->image_url }}" 
                                            class="w-full h-full object-cover" alt="{{ $detail->product->nama }}">
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $detail->product->nama }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">SKU: {{ $detail->product->sku ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300 rounded-lg text-xs font-semibold">
                                    × {{ $detail->quantity }}
                                </span>
                            </td>
                            <td class="p-4 font-bold text-green-600 dark:text-green-400">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    {{-- <button onclick="editDetail({{ $detail->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition">✏️</button> --}}
                                    <button onclick="deleteDetail({{ $detail->id }})" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition" title="Hapus Item">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">Tidak ada item dalam pesanan ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal (Optional, if needed for adding items later) -->
    <!-- ... same modal structure but with Tailwind classes ... -->
@endsection

@push('scripts')
<script>
    const orderData = @json($order->load('details.product'));
    let selectedProductData = null;

    // Search Function
    function searchTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.getElementById('detailsTable').getElementsByTagName('tbody')[0].rows;

        for (let row of rows) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        }
    }

    // Delete Detail
    function deleteDetail(detailId) {
        if (!confirm('Apakah Anda yakin ingin menghapus item ini dari pesanan?')) {
            return;
        }

        fetch(`/admin/pesanan/detail/${detailId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ ' + data.message);
                // Redirect to orders page or reload
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Terjadi kesalahan: ' + error.message);
        });
    }

    // Export Data -> Generate printable receipt (struk)
    function exportData() {
        if (!orderData) {
            alert('Data pesanan tidak tersedia.');
            return;
        }

        const o = orderData;
        const items = o.details || [];

        function fmt(n) {
            return new Intl.NumberFormat('id-ID').format(Number(n || 0));
        }

        const created = o.created_at ? new Date(o.created_at) : new Date();

        let rows = '';
        items.forEach(d => {
            const name = d.product ? (d.product.nama || d.product.name || '-') : '-';
            rows += `<tr>
                <td style="padding:6px 8px; border-bottom:1px solid #eee">${name}</td>
                <td style="padding:6px 8px; border-bottom:1px solid #eee; text-align:center">${d.quantity}</td>
                <td style="padding:6px 8px; border-bottom:1px solid #eee; text-align:right">Rp ${fmt(d.subtotal)}</td>
            </tr>`;
        });

        const subtotal = items.reduce((s, d) => s + Number(d.subtotal || 0), 0);

        const html = `<!doctype html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Struk - ${o.order_number}</title>
            <style>
                body{font-family: Arial, Helvetica, sans-serif; color:#111; padding:20px}
                .shop{font-weight:700; font-size:18px}
                .meta{margin-top:6px; color:#555}
                table{width:100%; border-collapse:collapse; margin-top:12px}
                th{text-align:left; padding:6px 8px; color:#333; font-weight:600}
                td{font-size:14px}
                .total{font-weight:700; font-size:16px; margin-top:12px}
                @media print { body{padding:8mm} .no-print{display:none} }
            </style>
        </head>
        <body>
            <div class="shop">Nand Second</div>
            <div class="meta">Struk: <strong>${o.order_number}</strong></div>
            <div class="meta">Customer: ${o.user ? (o.user.name || 'Guest') : 'Guest'}</div>
            <div class="meta">Tanggal: ${created.toLocaleString('id-ID')}</div>

            <table>
                <thead>
                    <tr><th>Produk</th><th style="text-align:center">Qty</th><th style="text-align:right">Subtotal</th></tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>

            <div class="total">Subtotal: Rp ${fmt(subtotal)}</div>
            <div class="total">Total: Rp ${fmt(o.total_harga)}</div>

            <div style="margin-top:18px; color:#666">Terima kasih atas pembelian Anda!</div>
            <div class="no-print" style="margin-top:12px"><button onclick="window.print()">Print</button></div>
        </body>
        </html>`;

        const w = window.open('', '_blank');
        w.document.open();
        w.document.write(html);
        w.document.close();
        w.focus();
        setTimeout(() => w.print(), 300);
    }

    function formatPhoneInput() {
        // Simple formatter
        const input = document.getElementById('contactPhone');
        // Logic to format phone if needed
    }

    // Update order status
    function updateStatus(orderId) {
        const status = document.getElementById('statusSelect').value;
        const email = document.getElementById('contactEmail').value.trim();
        const phone = document.getElementById('contactPhone').value.trim();
        const notify_via = [];
        if (document.getElementById('notifyEmail').checked) notify_via.push('email');
        if (document.getElementById('notifyWhatsapp').checked) notify_via.push('whatsapp');

        if (!confirm('Konfirmasi: update status pesanan dan kirim notifikasi?')) return;

        fetch(`/admin/pesanan/${orderId}/status`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status, notify_via: notify_via, phone: phone || null, email: email || null })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                alert('Status berhasil diupdate');
                if (data.wa_link && notify_via.includes('whatsapp')) {
                    window.open(data.wa_link, '_blank');
                }
                setTimeout(() => location.reload(), 800);
            } else {
                alert('Gagal: ' + (data.message || 'Unknown'));
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi error: ' + err.message);
        });
    }
</script>
@endpush