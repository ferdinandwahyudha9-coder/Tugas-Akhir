@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('header')
    @php
        $hour = date('H');
        $greeting = 'Selamat Pagi';
        if ($hour >= 12 && $hour < 15) $greeting = 'Selamat Siang';
        elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
        elseif ($hour >= 18) $greeting = 'Selamat Malam';
    @endphp
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ $greeting }}, Admin! 👋</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Berikut adalah ringkasan performa toko Anda hari ini.</p>
    </div>
@endsection

@section('actions')
    <div class="flex gap-3">
        <button onclick="location.href='{{ route('admin.users') }}'" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-medium shadow-sm transition text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah User
        </button>
        <button onclick="location.href='{{ route('admin.produk') }}'" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium shadow-sm transition text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Produk
        </button>
    </div>
@endsection

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-blue-500 group-hover:w-1.5 transition-all"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-green-600 flex items-center font-medium bg-green-50 px-2 py-0.5 rounded mr-2">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +12.5%
                </span>
                <span class="text-gray-400">vs bulan lalu</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-purple-500 group-hover:w-1.5 transition-all"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Order</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_orders'] }}</h3>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-green-600 flex items-center font-medium bg-green-50 px-2 py-0.5 rounded mr-2">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +5.2%
                </span>
                <span class="text-gray-400">vs bulan lalu</span>
            </div>
        </div>

        <!-- Products Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-emerald-500 group-hover:w-1.5 transition-all"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Produk Aktif</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_products'] }}</h3>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-blue-600 flex items-center font-medium bg-blue-50 px-2 py-0.5 rounded mr-2">
                    Stok Aman
                </span>
                <span class="text-gray-400">Low stock: 2 items</span>
            </div>
        </div>

        <!-- Users Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
            <div class="absolute right-0 top-0 h-full w-1 bg-orange-500 group-hover:w-1.5 transition-all"></div>
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pelanggan</p>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_users'] }}</h3>
                </div>
                <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <div class="flex items-center text-xs">
                <span class="text-green-600 flex items-center font-medium bg-green-50 px-2 py-0.5 rounded mr-2">
                    +3 Baru
                </span>
                <span class="text-gray-400">minggu ini</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 lg:col-span-2">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-gray-900 dark:text-white font-bold text-lg">Statistik Penjualan</h3>
                    <p class="text-gray-400 text-xs">Performa penjualan 7 hari terakhir</p>
                </div>
            </div>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-gray-900 dark:text-white font-bold text-lg">Kategori Populer</h3>
                    <p class="text-gray-400 text-xs">Distribusi produk terjual</p>
                </div>
            </div>
            <div class="h-64 flex items-center justify-center">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Orders Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 overflow-hidden lg:col-span-2">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                <h3 class="text-gray-900 dark:text-white font-bold text-lg">Pesanan Terbaru</h3>
                <a href="{{ route('admin.pesanan') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="p-4 px-6">ID Pesanan</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Total</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 text-right px-6">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-50">
                        @forelse($recent_orders as $order)
                        <tr class="hover:bg-blue-50/30 dark:hover:bg-gray-700/50 transition-colors group">
                            <td class="p-4 px-6 font-medium text-blue-600">#{{ $order->order_number }}</td>
                            <td class="p-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $order->user->name ?? 'Guest' }}</div>
                                <div class="text-xs text-gray-400">{{ $order->created_at->format('d M, H:i') }}</div>
                            </td>
                            <td class="p-4 font-medium text-gray-700 dark:text-gray-300">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td class="p-4 text-center">
                                @php
                                    $statusClasses = [
                                        'delivered' => 'bg-green-100 text-green-700 border-green-200',
                                        'shipped' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                        'processing' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'cancelled' => 'bg-red-100 text-red-700 border-red-200',
                                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                    ];
                                    $defaultClass = 'bg-gray-100 text-gray-700 border-gray-200';
                                    $class = $statusClasses[$order->status] ?? $defaultClass;
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-xs font-semibold border {{ $class }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="p-4 px-6 text-right">
                                <a href="{{ route('admin.pesanan.detail', $order->id) }}" class="text-gray-400 hover:text-blue-600 transition p-1 rounded-full hover:bg-blue-50 inline-block">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    Belum ada pesanan terbaru
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Activity Feed -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-gray-900 dark:text-white font-bold text-lg mb-6">Aktivitas Terbaru</h3>

            @php
                $activities = collect();
                foreach($recent_users as $user) {
                    $activities->push([ 'type' => 'user', 'timestamp' => $user->created_at, 'data' => $user ]);
                }
                foreach($recent_orders as $order) {
                    $activities->push([ 'type' => 'order', 'timestamp' => $order->created_at, 'data' => $order ]);
                }
                $activities = $activities->sortByDesc('timestamp')->take(6);
            @endphp

            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-100"></div>
                <div class="space-y-6">
                    @forelse($activities as $activity)
                        @if($activity['type'] == 'user')
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-blue-100 border-2 border-white ring-1 ring-blue-50 flex items-center justify-center text-sm flex-shrink-0 z-10">
                                    👤
                                </div>
                                <div class="flex-1 py-0.5">
                                    <p class="text-gray-800 dark:text-gray-200 text-sm"><span class="font-semibold">{{ $activity['data']->name }}</span> mendaftar sebagai pengguna baru.</p>
                                    <span class="text-gray-400 text-xs">{{ $activity['data']->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @elseif($activity['type'] == 'order')
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-green-100 border-2 border-white ring-1 ring-green-50 flex items-center justify-center text-sm flex-shrink-0 z-10">
                                    🛍️
                                </div>
                                <div class="flex-1 py-0.5">
                                    <p class="text-gray-800 dark:text-gray-200 text-sm">Pesanan baru <span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-1 py-0.5 rounded text-gray-600 dark:text-gray-300">#{{ $activity['data']->order_number }}</span> masuk.</p>
                                    <span class="text-gray-400 text-xs">{{ $activity['data']->created_at->diffForHumans() }} • <span class="text-green-600 dark:text-green-400 font-medium">Rp {{ number_format($activity['data']->total_harga, 0, ',', '.') }}</span></span>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-gray-400 py-4 text-sm">Belum ada aktivitas tercatat</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Chart Defaults
const isDark = document.documentElement.classList.contains('dark');
Chart.defaults.font.family = "'Inter', 'sans-serif'";
Chart.defaults.color = isDark ? '#94a3b8' : '#64748b';
Chart.defaults.scale.grid.color = isDark ? '#334155' : '#f1f5f9';

// Sales Chart
const salesCtx = document.getElementById('salesChart').getContext('2d');
const gradient = salesCtx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

new Chart(salesCtx, {
  type: 'line',
  data: {
    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
    datasets: [{
      label: 'Penjualan',
      data: [350000, 420000, 280000, 510000, 450000, 620000, 540000],
      borderColor: '#3b82f6',
      backgroundColor: gradient,
      tension: 0.4,
      fill: true,
      pointBackgroundColor: '#fff',
      pointBorderColor: '#3b82f6',
      pointBorderWidth: 2,
      pointRadius: 4,
      pointHoverRadius: 6
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#1e293b',
        padding: 12,
        titleFont: { size: 13 },
        bodyFont: { size: 13 },
        cornerRadius: 8,
        displayColors: false,
        callbacks: {
            label: function(context) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
            }
        }
      }
    },
    scales: {
      y: {
        beginAtZero: true,
        border: { display: false },
        ticks: {
          callback: function(value) {
            return 'Rp ' + (value/1000) + 'k';
          },
          padding: 10
        }
      },
      x: {
        grid: { display: false },
        border: { display: false }
      }
    }
  }
});

// Category Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
  type: 'doughnut',
  data: {
    labels: ['Home Kit', 'Away Kit', 'Third Kit', 'Training'],
    datasets: [{
      data: [35, 30, 20, 15],
      backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6'],
      borderWidth: 0,
      hoverOffset: 4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '75%',
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          padding: 20,
          usePointStyle: true,
          pointStyle: 'circle'
        }
      }
    }
  }
});
</script>
@endpush
