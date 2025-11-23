@extends('layouts.admin')

@section('title', 'Dashboard Staff - Dimsumlicious')
@section('page-title', 'Dashboard Staff')
@section('page-subtitle', 'Selamat datang di panel staff Dimsumlicious')

@section('content')
    <!-- Welcome Section -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center bounce-gentle">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Halo, <span class="text-primary">{{ $username ?? 'Staff' }}</span>!
                </h1>
                <p class="text-gray-600 mt-1">
                    Selamat bekerja! Kelola pesanan dan produk dengan baik.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <!-- Stats Cards - Limited for Staff -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Products -->
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
            </div>

            <!-- Low Stock Warning -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
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
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover border-l-4 border-secondary">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_sales']) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activities -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Aktivitas Terbaru
                    </h3>
                    <a href="{{ route('orders.index') }}"
                        class="text-primary hover:text-secondary text-sm font-medium transition-colors duration-300">
                        Lihat Pesanan
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

            <!-- Important Notes for Staff -->
            <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Catatan Penting
                    </h3>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Akses Terbatas</p>
                                <p class="text-xs text-blue-600 mt-1">Sebagai staff, Anda memiliki akses terbatas ke
                                    beberapa fitur admin.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-yellow-800">Cek Stok Rutin</p>
                                <p class="text-xs text-yellow-600 mt-1">Pastikan untuk selalu memeriksa dan melaporkan stok
                                    yang menipis.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-800">Layanan Pelanggan</p>
                                <p class="text-xs text-green-600 mt-1">Prioritaskan kepuasan pelanggan dalam setiap
                                    transaksi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions for Staff -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 card-hover">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Menu Akses Staff
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('products.index') }}"
                    class="flex items-center p-4 bg-primary text-white rounded-xl hover:bg-secondary transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Produk</p>
                        <p class="text-sm opacity-90">Kelola produk</p>
                    </div>
                </a>

                <a href="{{ route('categories.index') }}"
                    class="flex items-center p-4 bg-secondary text-white rounded-xl hover:bg-accent transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Kategori</p>
                        <p class="text-sm opacity-90">Kelola kategori</p>
                    </div>
                </a>

                <a href="{{ route('orders.index') }}"
                    class="flex items-center p-4 bg-accent text-gray-700 rounded-xl hover:bg-highlight transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Pesanan</p>
                        <p class="text-sm opacity-90">Proses pesanan</p>
                    </div>
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center p-4 bg-highlight text-gray-700 rounded-xl hover:bg-accent transition-all duration-300 btn-animated">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <div class="text-left">
                        <p class="font-medium">Profile</p>
                        <p class="text-sm opacity-90">Lihat profil</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
