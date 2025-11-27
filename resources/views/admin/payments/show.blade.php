@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div x-data="{ openRejectModal: false }" class="min-h-screen bg-gray-50 py-8">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <a href="{{ route('payments.index') }}" class="text-primary hover:underline mb-2 inline-block">
                    ← Kembali ke Daftar Pesanan
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

                <!-- LEFT -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Status -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Status Pesanan</h2>
                        <div class="flex items-center gap-4">
                            @include('admin.orders.status-badge', ['status' => $order->status])
                            <span class="text-sm text-gray-600">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Item Pesanan</h2>

                        <div class="space-y-4">
                            @foreach ($order->orderItems as $item)
                                <div class="flex items-center gap-4 pb-4 border-b last:border-0">
                                    <div class="w-20 h-20 shrink-0">
                                        @if ($item->product && $item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                class="w-full h-full object-cover rounded">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-2xl">🥟</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="grow">
                                        <h3 class="font-semibold text-gray-900">{{ $item->product_name }}</h3>
                                        <p class="text-sm text-gray-600">
                                            {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </p>
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
                                <p class="text-gray-900">{{ $order->phone_number ?? '-' }}</p>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600 mb-1">Catatan Pemesanan</p>
                                <span class="text-gray-900 whitespace-pre-line">{{ $order->customer_notes ?: '-' }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT -->
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

                    <!-- Payment Info -->
                    @if ($order->payment)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Pembayaran</h2>

                            <p class="text-sm text-gray-700 mb-2">
                                Status: <strong>{{ strtoupper($order->payment->status) }}</strong>
                            </p>

                            @if ($order->payment->proof_image)
                                <p class="text-sm text-gray-600 mb-2">Bukti Pembayaran:</p>
                                <img src="{{ asset('storage/' . $order->payment->proof_image) }}"
                                    class="w-full rounded-lg border mb-4">
                            @endif

                            {{-- Tombol verifikasi & tolak hanya jika pending --}}
                            @if ($order->payment->status === 'pending')
                                <div class="flex gap-2 mt-4">
                                    <form action="{{ route('payments.verify', $order->payment->id) }}" method="POST">
                                        @csrf
                                        <button class="bg-primary text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                            <!-- Heroicons: Check -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Verifikasi
                                        </button>
                                    </form>

                                    <button type="button" @click="openRejectModal = true"
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                                        <!-- Heroicons: X Mark -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tolak
                                    </button>
                                </div>
                            @endif

                            {{-- Jika sudah ditolak tampilkan alasannya --}}
                            @if ($order->payment->status === 'rejected' && $order->payment->rejection_reason)
                                <div class="mt-4 bg-red-100 border border-red-300 text-red-800 p-3 rounded">
                                    <strong>Alasan Penolakan:</strong>
                                    <p>{{ $order->payment->rejection_reason }}</p>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- MODAL PENOLAKAN --}}
        <template x-if="openRejectModal">
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">

                    <h2 class="text-lg font-bold text-gray-900 mb-4">Alasan Penolakan</h2>

                    <form action="{{ route('payments.reject', $order->payment->id) }}" method="POST">
                        @csrf
                        <textarea name="rejection_reason" required minlength="5"
                            class="w-full border rounded-lg p-2 focus:ring-primary focus:border-primary" rows="4"
                            placeholder="Tuliskan alasan penolakan pembayaran..."></textarea>

                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" @click="openRejectModal = false"
                                class="px-4 py-2 bg-gray-300 rounded-lg">
                                Batal
                            </button>

                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">
                                Kirim Penolakan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </template>

    </div>
@endsection
