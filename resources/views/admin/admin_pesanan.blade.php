@extends('layouts.admin')

@section('title', 'Pesanan')

@section('header')
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">🛒 Order Management</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Kelola semua pesanan pelanggan Anda</p>
    </div>
@endsection

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-yellow-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-yellow-100 dark:bg-yellow-900/50 flex items-center justify-center text-xl">⏳</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Pending</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $orders->where('status', 'pending')->count() }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-blue-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center text-xl">📦</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Processing</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $orders->where('status', 'processing')->count() }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-purple-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900/50 flex items-center justify-center text-xl">🚚</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Shipped</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $orders->where('status', 'shipped')->count() }}</div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border-l-4 border-green-500 flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900/50 flex items-center justify-center text-xl">✅</div>
            <div>
                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase">Delivered</div>
                <div class="text-2xl font-bold text-gray-800 dark:text-white">{{ $orders->where('status', 'delivered')->count() }}</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4 flex-wrap">
            <div class="flex-1 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
                <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Cari order number, nama customer..." 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm transition-shadow dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
            </div>
            
            <select id="statusFilter" onchange="filterByStatus()" 
                class="w-full md:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white dark:bg-gray-700 dark:text-white">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
            
            <button onclick="resetFilters()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition text-sm flex items-center gap-2">
                🔄 Reset
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table id="ordersTable" class="w-full text-left border-collapse">
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-600 dark:text-gray-400 uppercase text-xs font-semibold border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="p-4">Order Number</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 dark:text-gray-300 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="p-4 font-mono font-semibold text-blue-600">{{ $order->order_number }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs">
                                        {{ $order->user ? substr($order->user->name, 0, 1) : '?' }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">{{ $order->user->name ?? 'Guest' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order->user->email ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 whitespace-nowrap">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-4 font-medium text-gray-900 dark:text-white">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'shipped' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300',
                                        'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300',
                                        'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300',
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $class }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <button onclick="viewOrder({{ $order->id }})" class="px-3 py-1.5 bg-purple-50 text-purple-600 rounded hover:bg-purple-100 font-medium text-xs transition-colors">👁️ View</button>
                                    <button onclick="editOrder({{ $order->id }})" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 font-medium text-xs transition-colors">✏️ Edit</button>
                                    <button onclick="deleteOrder({{ $order->id }})" class="px-3 py-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 font-medium text-xs transition-colors">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-700 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div id="editOrderModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeEditModal()"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-white">✏️ Edit Status Pesanan</h3>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="text-2xl">&times;</span>
                        </button>
                    </div>

                    <form id="orderForm">
                        <input type="hidden" id="orderId">
                        
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Pesanan</label>
                            <select id="orderStatus" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white dark:bg-gray-700 dark:text-white">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="flex gap-3 justify-end">
                            <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition text-sm">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition text-sm shadow-sm">💾 Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // View Order
    function viewOrder(orderId) {
        window.location.href = `/admin/pesanan/${orderId}`;
    }

    // Delete Order
    function deleteOrder(orderId) {
        if (!confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
            return;
        }

        fetch(`/admin/pesanan/${orderId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ Pesanan berhasil dihapus');
                location.reload();
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('❌ Terjadi kesalahan: ' + error.message);
        });
    }

    // Edit Order
    function editOrder(orderId) {
        document.getElementById('orderId').value = orderId;
        // In a real scenario, you might want to fetch the current status or pass it in the function call
        // For now, it just opens the modal
        const modal = document.getElementById('editOrderModal');
        modal.classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editOrderModal').classList.add('hidden');
    }

    // Form Submit
    document.getElementById('orderForm').onsubmit = async function (e) {
        e.preventDefault();

        const orderId = document.getElementById('orderId').value;
        const status = document.getElementById('orderStatus').value;

        try {
            const response = await fetch(`/admin/pesanan/${orderId}/status`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            });

            const result = await response.json();

            if (result.success) {
                alert('✅ Status pesanan berhasil diubah!');
                location.reload();
            } else {
                alert('❌ Gagal: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('❌ Terjadi kesalahan');
        }
    }

    // Search Function
    function searchTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.getElementById('ordersTable').getElementsByTagName('tbody')[0].rows;

        for (let row of rows) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        }
    }

    // Filter Functions
    function filterByStatus() {
        const status = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.getElementById('ordersTable').getElementsByTagName('tbody')[0].rows;

        for (let row of rows) {
            if (status === '') {
                row.style.display = '';
            } else {
                const statusCell = row.cells[4].innerText.toLowerCase(); // Use innerText to get text content of badge
                row.style.display = statusCell.includes(status) ? '' : 'none';
            }
        }
    }

    function resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('statusFilter').value = '';

        const rows = document.getElementById('ordersTable').getElementsByTagName('tbody')[0].rows;
        for (let row of rows) {
            row.style.display = '';
        }
    }
</script>
@endpush