@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Keranjang Belanja</h1>
                <p class="mt-2 text-gray-600">Kelola pesanan Anda sebelum checkout</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($carts->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($carts as $cart)
                            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                                <div class="flex items-center gap-4">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 flex-shrink-0">
                                        @if ($cart->product->image)
                                            <img src="{{ asset('storage/' . $cart->product->image) }}"
                                                alt="{{ $cart->product->name }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div
                                                class="w-full h-full bg-gray-200 rounded-lg flex items-center justify-center">
                                                <span class="text-3xl">🥟</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $cart->product->name }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">Rp
                                            {{ number_format($cart->price, 0, ',', '.') }}</p>

                                        @if ($cart->product->stock < 5)
                                            <p class="text-xs text-red-600 mt-1">Stok tersisa: {{ $cart->product->stock }}
                                            </p>
                                        @endif

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center gap-2 mt-3">
                                            <form action="{{ route('cart.update', $cart->id) }}" method="POST"
                                                class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" name="quantity"
                                                    value="{{ max(1, $cart->quantity - 1) }}"
                                                    class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <span class="w-12 text-center font-semibold">{{ $cart->quantity }}</span>
                                                <button type="submit" name="quantity" value="{{ $cart->quantity + 1 }}"
                                                    class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-full flex items-center justify-center"
                                                    @if ($cart->quantity >= $cart->product->stock) disabled @endif>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Subtotal & Remove -->
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900">
                                            Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                        </p>
                                        <form action="{{ route('cart.remove', $cart->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Clear Cart -->
                        <form action="{{ route('cart.clear') }}" method="POST"
                            onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal ({{ $carts->count() }} item)</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="border-t pt-4 mb-6">
                                <div class="flex justify-between text-lg font-bold text-gray-900">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout') }}"
                                class="block w-full bg-primary hover:bg-opacity-90 text-white font-semibold py-3 rounded-lg text-center transition-colors">
                                Lanjut ke Checkout
                            </a>

                            <a href="{{ route('user.products') }}"
                                class="block w-full mt-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg text-center transition-colors">
                                Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Kosong</h2>
                    <p class="text-gray-600 mb-6">Belum ada produk di keranjang Anda</p>
                    <a href="{{ route('user.products') }}"
                        class="inline-block bg-primary hover:bg-opacity-90 text-white font-semibold px-8 py-3 rounded-lg transition-colors">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
