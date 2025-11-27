@extends('layouts.user')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('user.orders') }}" class="text-primary hover:underline mb-2 inline-block">
                    ← Kembali ke Pesanan Saya
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Detail Pesanan</h1>
                <p class="mt-2 text-gray-600">{{ $order->order_number }}</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT SIDE -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Status -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Status Pesanan</h2>
                        <div class="flex items-center gap-4">
                            {{-- ORDER STATUS --}}
                            @if ($order->payment)
                                @if ($order->payment->status === 'pending' && !$order->payment->proof_image)
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Belum Upload Bukti Pembayaran
                                    </span>
                                @elseif ($order->payment->status === 'pending' && $order->payment->proof_image)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Menunggu Verifikasi Pembayaran
                                    </span>
                                @elseif ($order->payment->status === 'verified')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Pembayaran Terverifikasi
                                    </span>
                                @elseif ($order->payment->status === 'rejected')
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                        <p class="text-sm text-red-800 mb-1">✗ Pembayaran ditolak</p>

                                        @if ($order->payment->verification_notes)
                                            <p class="text-xs text-red-700">
                                                Alasan: {{ $order->payment->verification_notes }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            @endif

                            {{-- STATUS ORDER --}}
                            @if ($order->status === 'pending')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu Pembayaran
                                </span>
                            @elseif ($order->status === 'pending_cooking')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Diproses
                                </span>
                            @elseif ($order->status === 'ready')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    Siap Diambil
                                </span>
                            @elseif ($order->status === 'completed')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Selesai
                                </span>
                            @elseif ($order->status === 'cancelled')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Dibatalkan
                                </span>
                            @endif
                            <span class="text-sm text-gray-600">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Item Pesanan</h2>

                        <div class="space-y-4">
                            @foreach ($order->orderItems as $item)
                                <div class="flex items-center gap-4 pb-4 border-b last:border-0">

                                    <div class="w-20 h-20 flex-shrink-0">
                                        @if ($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                alt="{{ $item->product_name }}" class="w-full h-full object-cover rounded">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-2xl">🥟</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow">
                                        <h3 class="font-semibold text-gray-900">{{ $item->product_name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">Rp
                                            {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Buyer Info -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Informasi Pembeli</h2>

                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-600">Nama</p>
                                <p class="text-gray-900">{{ $order->user->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Nomor Telepon</p>
                                <p class="text-gray-900">{{ $order->phone_number ?? ($order->user->phone ?? '-') }}</p>
                            </div>

                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-1">Catatan Pemesanan</p>
                                <span class="text-gray-900 whitespace-pre-line">{{ $order->customer_notes ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="lg:col-span-1 space-y-6">

                    <!-- Payment Summary -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pembayaran</h2>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between text-gray-600">
                                <span>Pajak</span>
                                <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t pt-4">
                            <div class="flex justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Upload -->
                    @if ($order->payment)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Bukti Pembayaran</h2>

                            @if ($order->payment->status === 'pending' && !$order->payment->proof_image)
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-yellow-800">Silakan upload bukti pembayaran</p>
                                </div>
                            @elseif ($order->payment->status === 'pending' && $order->payment->proof_image)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-blue-800">Menunggu verifikasi admin</p>
                                </div>
                            @elseif ($order->payment->status === 'approved')
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-green-800">✓ Pembayaran terverifikasi</p>
                                </div>
                            @elseif ($order->payment->status === 'rejected')
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-red-800 mb-1">✗ Pembayaran ditolak</p>
                                    @if ($order->payment->rejection_reason)
                                        <p class="text-xs text-red-700">Alasan: {{ $order->payment->rejection_reason }}</p>
                                    @endif
                                </div>
                            @endif

                            @if ($order->payment->proof_image)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $order->payment->proof_image) }}"
                                        alt="Bukti Pembayaran" class="w-full rounded-lg border">
                                </div>
                            @endif

                            @if ($order->payment->status === 'pending')
                                <!-- QRIS Image -->
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Scan QRIS untuk melakukan pembayaran:
                                    </p>
                                    <img src="{{ asset('asset/foto/qris/qris.jpg') }}" class="w-full rounded-lg border">
                                </div>

                                <form action="{{ route('user.orders.upload-payment', $order->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload Bukti Transfer
                                    </label>

                                    <input type="file" name="proof_image" accept="image/*" required
                                        class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-4">

                                    @error('proof_image')
                                        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
                                    @enderror

                                    <button type="submit"
                                        class="w-full bg-primary hover:bg-opacity-90 text-white font-semibold py-2 rounded-lg transition-colors">
                                        Upload
                                    </button>
                                </form>
                            @endif


                            <div class="mt-4 pt-4 border-t">
                                <p class="text-xs text-gray-500">
                                    Metode: {{ strtoupper($order->payment->payment_method) }}<br>
                                    Format: JPG, JPEG, PNG (Max 2MB)
                                </p>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
