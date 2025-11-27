@extends('layouts.admin')

@section('title', 'Dashboard - Dimsumlicious')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di panel admin Dimsumlicious')

@section('content')
    <!-- Welcome Section -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center overflow-hidden">
                <img src="{{ asset('asset/foto/logo/dimsum.png') }}" class="w-full h-full object-cover" alt="Company Logo">
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Halo, <span class="text-primary">{{ $username ?? 'Admin' }}</span>!
                </h1>
                <p class="text-gray-600 mt-1">
                    Kelola bisnis dimsum Anda dengan mudah dan efisien.
                </p>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-primary">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_products']) }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    @if ($stats['product_growth'] > 0)
                        <span class="text-green-600 text-sm font-medium">+{{ number_format($stats['product_growth'], 1) }}%
                            dari bulan lalu</span>
                    @elseif($stats['product_growth'] < 0)
                        <span class="text-red-600 text-sm font-medium">{{ number_format($stats['product_growth'], 1) }}%
                            dari bulan lalu</span>
                    @else
                        <span class="text-gray-600 text-sm font-medium">Tidak ada perubahan</span>
                    @endif
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-secondary">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Stok Rendah</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['low_stock'] }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    @if ($stats['low_stock_change'] > 0)
                        <span class="text-red-600 text-sm font-medium">+{{ $stats['low_stock_change'] }} dari kemarin</span>
                    @elseif($stats['low_stock_change'] < 0)
                        <span class="text-green-600 text-sm font-medium">{{ $stats['low_stock_change'] }} dari
                            kemarin</span>
                    @else
                        <span class="text-gray-600 text-sm font-medium">Tidak ada perubahan</span>
                    @endif
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-accent">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-accent rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Penjualan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_sales']) }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    @if ($stats['sales_growth'] > 0)
                        <span class="text-green-600 text-sm font-medium">+{{ number_format($stats['sales_growth'], 1) }}%
                            dari bulan lalu</span>
                    @elseif($stats['sales_growth'] < 0)
                        <span class="text-red-600 text-sm font-medium">{{ number_format($stats['sales_growth'], 1) }}% dari
                            bulan lalu</span>
                    @else
                        <span class="text-gray-600 text-sm font-medium">Tidak ada perubahan</span>
                    @endif
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-highlight">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-highlight rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Pendapatan</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    @if ($stats['revenue_growth'] > 0)
                        <span class="text-green-600 text-sm font-medium">+{{ number_format($stats['revenue_growth'], 1) }}%
                            dari bulan lalu</span>
                    @elseif($stats['revenue_growth'] < 0)
                        <span class="text-red-600 text-sm font-medium">{{ number_format($stats['revenue_growth'], 1) }}%
                            dari bulan lalu</span>
                    @else
                        <span class="text-gray-600 text-sm font-medium">Tidak ada perubahan</span>
                    @endif
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Statistik Penjualan
                    </h3>
                    <div class="flex space-x-2">
                        <button
                            class="px-3 py-1 bg-primary text-white rounded-full text-sm hover:bg-secondary transition-colors duration-300">
                            Bulanan
                        </button>
                        <button
                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm hover:bg-gray-300 transition-colors duration-300">
                            Mingguan
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto -mx-2 px-2">
                    <div class="h-48 sm:h-56 md:h-64 min-w-[560px] flex items-end justify-between space-x-2">
                        @foreach ($chartData['labels'] as $index => $label)
                            <div class="flex flex-col items-center space-y-2">
                                <div class="flex flex-col space-y-1">
                                    <div class="w-5 sm:w-6 md:w-8 bg-primary rounded-t"
                                        style="height: {{ $chartData['datasets'][0]['data'][$index] }}px;"></div>
                                    <div class="w-5 sm:w-6 md:w-8 bg-secondary rounded-t"
                                        style="height: {{ $chartData['datasets'][1]['data'][$index] }}px;"></div>
                                </div>
                                <span class="text-[10px] sm:text-xs text-gray-600">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center space-x-6 mt-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-primary rounded-full"></div>
                        <span class="text-sm text-gray-600">Penjualan Dimsum</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-secondary rounded-full"></div>
                        <span class="text-sm text-gray-600">Produk Terjual</span>
                    </div>
                </div>
            </div>


            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Aktivitas Terbaru
                    </h3>
                    <a href="{{ route('products.index') }}"
                        class="text-primary hover:text-secondary text-sm font-medium transition-colors duration-300">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-3 sm:space-y-4">
                    @foreach ($recentActivities as $activity)
                        <div
                            class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-accent rounded-full flex items-center justify-center">
                                    @if ($activity['icon'] === 'shopping-cart')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
                                        </svg>
                                    @elseif($activity['icon'] === 'chart-bar')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    @elseif($activity['icon'] === 'exclamation-triangle')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                    @elseif($activity['icon'] === 'trending-up')
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{ $activity['action'] }}</p>
                                <p class="text-xs text-gray-500">{{ $activity['user'] }} • {{ $activity['time'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 card-hover">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Aksi Cepat
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('products.index') }}"
                    class="flex items-center p-4 bg-primary text-white rounded-xl hover:bg-secondary transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Pengelolaan Produk</p>
                        <p class="text-sm opacity-90">Kelola produk dimsum</p>
                    </div>
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center p-4 bg-secondary text-white rounded-xl hover:bg-accent transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Profile</p>
                        <p class="text-sm opacity-90">Lihat profil Anda</p>
                    </div>
                </a>

                <button
                    class="flex items-center p-4 bg-accent text-gray-700 rounded-xl hover:bg-highlight transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Laporan</p>
                        <p class="text-sm opacity-90">Generate laporan</p>
                    </div>
                </button>
            </div>
        </div>
    </div>
@endsection
