@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Laporan</h1>
            <p class="text-gray-600 mt-1">Dashboard laporan penjualan dan statistik bisnis</p>
        </div>

        <!-- Filter Period -->
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6 mb-6">
            <form action="{{ route('reports.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Periode</label>
                        <select name="period" id="periodSelect" onchange="toggleCustomDate()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                            <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                            <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>

                    <div id="customDateFields" class="hidden sm:col-span-2 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                            <input type="date" name="start_date" value="{{ $startDate }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ $endDate }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 font-medium">
                            Tampilkan
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">
                    Menampilkan data dari <strong>{{ Carbon\Carbon::parse($startDate)->format('d M Y') }}</strong>
                    sampai <strong>{{ Carbon\Carbon::parse($endDate)->format('d M Y') }}</strong>
                </p>
            </form>
        </div>

        <!-- Main Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-green-100 text-sm">Total Pendapatan</p>
                        <h3 class="text-2xl font-bold mt-1">Rp
                            {{ number_format($salesStats['total_revenue'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                @if ($previousPeriod['total_revenue'] > 0)
                    @php
                        $revenueGrowth =
                            (($salesStats['total_revenue'] - $previousPeriod['total_revenue']) /
                                $previousPeriod['total_revenue']) *
                            100;
                    @endphp
                    <div class="flex items-center text-sm">
                        @if ($revenueGrowth >= 0)
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>+{{ number_format($revenueGrowth, 1) }}%</span>
                        @else
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ number_format($revenueGrowth, 1) }}%</span>
                        @endif
                        <span class="ml-1 opacity-80">vs periode sebelumnya</span>
                    </div>
                @endif
            </div>

            <!-- Total Orders -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-blue-100 text-sm">Total Pesanan</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $salesStats['total_orders'] }}</h3>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </div>
                </div>
                @if ($previousPeriod['total_orders'] > 0)
                    @php
                        $orderGrowth =
                            (($salesStats['total_orders'] - $previousPeriod['total_orders']) /
                                $previousPeriod['total_orders']) *
                            100;
                    @endphp
                    <div class="flex items-center text-sm">
                        @if ($orderGrowth >= 0)
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>+{{ number_format($orderGrowth, 1) }}%</span>
                        @else
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ number_format($orderGrowth, 1) }}%</span>
                        @endif
                        <span class="ml-1 opacity-80">vs periode sebelumnya</span>
                    </div>
                @endif
            </div>

            <!-- Average Order Value -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-purple-100 text-sm">Rata-rata Nilai Order</p>
                        <h3 class="text-2xl font-bold mt-1">Rp
                            {{ number_format($salesStats['average_order_value'], 0, ',', '.') }}</h3>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm opacity-80">dari {{ $salesStats['completed_orders'] }} order selesai</p>
            </div>

            <!-- Completed Orders -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-yellow-100 text-sm">Order Selesai</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $salesStats['completed_orders'] }}</h3>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <p class="text-sm opacity-80">{{ $salesStats['pending_orders'] }} menunggu,
                    {{ $salesStats['processing_orders'] }} diproses</p>
            </div>
        </div>

        <!-- Charts & Details Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Revenue Summary Cards -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pendapatan</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $revenueData = collect($dailyRevenue);
                        $totalRev = $revenueData->sum('revenue');
                        $avgRev = $revenueData->avg('revenue');
                        $maxRev = $revenueData->max('revenue');
                        $totalDays = $revenueData->count();
                    @endphp
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4">
                        <p class="text-xs text-gray-600 mb-1">Total</p>
                        <p class="text-xl font-bold text-green-700">Rp {{ number_format($totalRev, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4">
                        <p class="text-xs text-gray-600 mb-1">Rata-rata/Hari</p>
                        <p class="text-xl font-bold text-blue-700">Rp {{ number_format($avgRev, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4">
                        <p class="text-xs text-gray-600 mb-1">Tertinggi</p>
                        <p class="text-xl font-bold text-purple-700">Rp {{ number_format($maxRev, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-4">
                        <p class="text-xs text-gray-600 mb-1">Jumlah Hari</p>
                        <p class="text-xl font-bold text-orange-700">{{ $totalDays }} hari</p>
                    </div>
                </div>

                <!-- Top 5 Revenue Days -->
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">🔥 5 Hari Pendapatan Tertinggi</h3>
                    <div class="space-y-2">
                        @foreach ($revenueData->sortByDesc('revenue')->take(5) as $day)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span
                                    class="text-sm text-gray-700">{{ is_array($day) ? $day['formatted_date'] : $day->formatted_date }}</span>
                                <span class="text-sm font-bold text-green-600">Rp
                                    {{ number_format(is_array($day) ? $day['revenue'] : $day->revenue, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Status Distribution -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Status Pesanan</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Selesai</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $salesStats['completed_orders'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full"
                                style="width: {{ $salesStats['total_orders'] > 0 ? ($salesStats['completed_orders'] / $salesStats['total_orders']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Diproses</span>
                            <span
                                class="text-sm font-semibold text-gray-800">{{ $salesStats['processing_orders'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full"
                                style="width: {{ $salesStats['total_orders'] > 0 ? ($salesStats['processing_orders'] / $salesStats['total_orders']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm text-gray-600">Pending Pembayaran</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $salesStats['pending_orders'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full"
                                style="width: {{ $salesStats['total_orders'] > 0 ? ($salesStats['pending_orders'] / $salesStats['total_orders']) * 100 : 0 }}%">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Status Pembayaran</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">✓ Terverifikasi</span>
                            <span
                                class="text-sm font-semibold text-green-600">{{ $paymentStats['verified_payments'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">⏱ Pending</span>
                            <span
                                class="text-sm font-semibold text-yellow-600">{{ $paymentStats['pending_payments'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">✗ Ditolak</span>
                            <span
                                class="text-sm font-semibold text-red-600">{{ $paymentStats['rejected_payments'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products & Revenue by Category -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Products -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Produk Terlaris</h2>
                <div class="space-y-3">
                    @forelse($topProducts as $index => $product)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full 
                                    {{ $index === 0 ? 'bg-yellow-400 text-white' : ($index === 1 ? 'bg-gray-400 text-white' : ($index === 2 ? 'bg-orange-400 text-white' : 'bg-gray-200 text-gray-600')) }} 
                                    font-bold text-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $product->product_name }}</p>
                                    <p class="text-xs text-gray-500">Terjual: {{ $product->total_sold }} unit</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-green-600">Rp
                                    {{ number_format($product->total_revenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada data penjualan</p>
                    @endforelse
                </div>
            </div>

            <!-- Revenue by Category -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Pendapatan per Kategori</h2>
                <div class="space-y-3">
                    @php
                        $totalCategoryRevenue = $revenueByCategory->sum('total_revenue');
                    @endphp
                    @forelse($revenueByCategory as $category)
                        <div class="p-3 bg-gray-50 rounded-lg">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold text-gray-800">{{ $category->category_name }}</span>
                                <span class="text-sm font-semibold text-green-600">Rp
                                    {{ number_format($category->total_revenue, 0, ',', '.') }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full"
                                    style="width: {{ $totalCategoryRevenue > 0 ? ($category->total_revenue / $totalCategoryRevenue) * 100 : 0 }}%">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $totalCategoryRevenue > 0 ? number_format(($category->total_revenue / $totalCategoryRevenue) * 100, 1) : 0 }}%
                                dari total pendapatan
                            </p>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada data kategori</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Stock Alerts & Recent Orders -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Stock Alerts -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Peringatan Stok
                </h2>

                @if ($lowStockProducts->count() > 0 || $outOfStockProducts->count() > 0)
                    <div class="space-y-3">
                        @foreach ($outOfStockProducts as $product)
                            <div class="flex items-center justify-between p-3 bg-red-50 border border-red-200 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-red-600 font-medium">Stok Habis</p>
                                </div>
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">0</span>
                            </div>
                        @endforeach

                        @foreach ($lowStockProducts as $product)
                            <div
                                class="flex items-center justify-between p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $product->name }}</p>
                                    <p class="text-sm text-yellow-600 font-medium">Stok Menipis</p>
                                </div>
                                <span
                                    class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">{{ $product->stock }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">Semua stok dalam kondisi baik ✓</p>
                @endif
            </div>

            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Pesanan Terbaru</h2>
                <div class="space-y-3">
                    @forelse($recentOrders->take(5) as $order)
                        <div
                            class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->name }} •
                                    {{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}
                                </p>
                                <span
                                    class="text-xs px-2 py-1 rounded-full 
                                    {{ $order->status === 'completed'
                                        ? 'bg-green-100 text-green-700'
                                        : ($order->status === 'pending_payment'
                                            ? 'bg-blue-100 text-blue-700'
                                            : ($order->status === 'pending_cooking'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : 'bg-red-100 text-red-700')) }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">Belum ada pesanan</p>
                    @endforelse
                </div>
                @if ($recentOrders->count() > 0)
                    <a href="{{ route('orders.index') }}"
                        class="block text-center mt-4 text-primary hover:underline text-sm font-medium">
                        Lihat Semua Pesanan →
                    </a>
                @endif
            </div>
        </div>

        @if ($role === 'admin' && $customerStats)
            <!-- Customer Statistics (Admin Only) -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Statistik Customer</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Total Customer</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $customerStats['total_customers'] }}</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-1">Customer Baru Periode Ini</p>
                        <p class="text-3xl font-bold text-green-600">{{ $customerStats['new_customers_this_period'] }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            // Toggle custom date fields
            function toggleCustomDate() {
                const period = document.getElementById('periodSelect').value;
                const customFields = document.getElementById('customDateFields');
                if (period === 'custom') {
                    customFields.classList.remove('hidden');
                } else {
                    customFields.classList.add('hidden');
                }
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                toggleCustomDate();
            });
        </script>
    @endpush
@endsection
