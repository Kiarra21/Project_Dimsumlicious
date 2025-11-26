@extends('layouts.user')

@section('title', 'Checkout')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                <p class="mt-2 text-gray-600">Lengkapi informasi sebelum membuat pesanan</p>
            </div>

            <!-- Checkout Form -->
            <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf

                <!-- =================== LEFT SIDE =================== -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Catatan Pesanan -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Catatan Pesanan (Opsional)</h2>

                        <textarea name="notes" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Contoh: Level pedas, tanpa bawang, dll">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Daftar Item -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Item Pesanan ({{ $carts->count() }})</h2>

                        <div class="space-y-4">
                            @foreach ($carts as $cart)
                                <div class="flex items-center gap-4 pb-4 border-b last:border-0">

                                    <div class="w-16 h-16 flex-shrink-0">
                                        @if ($cart->product->image)
                                            <img src="{{ asset('storage/' . $cart->product->image) }}"
                                                class="w-full h-full object-cover rounded">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-2xl">🍽️</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow">
                                        <h3 class="font-semibold text-gray-900">{{ $cart->product->name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $cart->quantity }} x Rp {{ number_format($cart->price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="text-right font-semibold text-gray-900">
                                        Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- =================== RIGHT SIDE =================== -->
                <div class="lg:col-span-1">

                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-8">

                        <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Info pembayaran di step selanjutnya -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-gray-900">Pembayaran</h3>
                            <p class="text-sm text-gray-600">
                                Setelah pesanan dibuat, kamu akan diarahkan ke halaman pembayaran untuk upload bukti
                                transfer.
                            </p>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full bg-primary hover:bg-opacity-90 text-white font-semibold py-3 rounded-lg transition">
                            Buat Pesanan
                        </button>

                        <a href="{{ route('cart.index') }}"
                            class="block w-full mt-3 text-center text-gray-600 hover:text-gray-800 font-medium py-2">
                            Kembali ke Keranjang
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection
