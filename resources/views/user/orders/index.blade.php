@extends('layouts.user')

@section('title', 'Pesanan Saya')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
                <p class="mt-2 text-gray-600">Kelola pesanan Anda</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($orders->count() > 0)
                <div class="space-y-4">
                    @foreach ($orders as $order)
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <!-- Order Header -->
                            <div class="text-right">
                                @if ($order->payment && $order->payment->status === 'pending')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi Pembayaran
                                    </span>
                                @elseif ($order->payment && $order->payment->status === 'rejected')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Pembayaran Ditolak
                                    </span>
                                @elseif ($order->payment && $order->payment->status === 'verified')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Pembayaran Terverifikasi
                                    </span>
                                @endif

                                {{-- Status dari tabel orders --}}
                                @if ($order->status === 'pending_cooking')
                                    <span
                                        class="ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Diproses
                                    </span>
                                @elseif ($order->status === 'completed')
                                    <span
                                        class="ml-2 px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @endif
                            </div>


                            <!-- Order Items Preview -->
                            <div class="mb-4">
                                <div class="space-y-2">
                                    @foreach ($order->orderItems->take(2) as $item)
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 flex-shrink-0">
                                                @if ($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                                        alt="{{ $item->product_name }}"
                                                        class="w-full h-full object-cover rounded">
                                                @else
                                                    <div
                                                        class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                        <span class="text-xl">🥟</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-grow">
                                                <p class="text-sm font-semibold text-gray-900">{{ $item->product_name }}</p>
                                                <p class="text-xs text-gray-600">{{ $item->quantity }} x Rp
                                                    {{ number_format($item->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($order->orderItems->count() > 2)
                                        <p class="text-sm text-gray-500">+{{ $order->orderItems->count() - 2 }} item lainnya
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Footer -->
                            <div class="flex items-center justify-between pt-4 border-t">
                                <div>
                                    <p class="text-sm text-gray-600">Total Pembayaran</p>
                                    <p class="text-lg font-bold text-gray-900">Rp
                                        {{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>
                                <a href="{{ route('user.orders.show', $order->id) }}"
                                    class="px-6 py-2 bg-primary hover:bg-opacity-90 text-white font-semibold rounded-lg transition-colors">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h2>
                    <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan</p>
                    <a href="{{ route('user.products') }}"
                        class="inline-block bg-primary hover:bg-opacity-90 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
