@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('orders.index') }}" class="text-primary hover:underline mb-2 inline-block">
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

                        <!-- UPDATE STATUS (ADMIN) -->
                        @if ($order->payment && $order->payment->status === 'verified')
                            <!-- UPDATE STATUS (ADMIN) -->
                            <form action="{{ route('orders.update-status', $order->id) }}" method="POST" class="mt-4">
                                @csrf
                                @method('PUT')

                                <label class="text-sm font-semibold">Ubah Status Pesanan:</label>
                                <select id="orderStatusSelect" name="status" class="w-full border rounded px-3 py-2 mt-1">
                                    <option value="pending_cooking" @selected($order->status == 'pending_cooking')>
                                        Sedang Diproses
                                    </option>
                                    <option value="completed" @selected($order->status == 'completed')>
                                        Selesai
                                    </option>
                                </select>


                                <div id="rejectionReasonWrap" class="mt-3"
                                    style="display: {{ $order->status === 'rejected' ? 'block' : 'none' }};">
                                    <label class="text-sm font-semibold">Alasan Penolakan</label>
                                    <textarea name="rejection_reason" class="w-full border rounded px-3 py-2 mt-1" rows="3">{{ old('rejection_reason', $order->rejection_reason ?? '') }}</textarea>
                                </div>

                                <button class="mt-3 bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90">
                                    Simpan
                                </button>
                            </form>
                        @else
                            <p class="mt-4 text-sm text-gray-600 italic">
                                🔒 Status pesanan tidak dapat diubah sebelum pembayaran diverifikasi.
                            </p>
                        @endif

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
                                                class="w-full h-full object-cover rounded">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-2xl">🥟</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow">
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
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Informasi Pembeli</h2>
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-600">Nama</p>
                                <p class="text-gray-900">{{ $order->user->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600">Nomor Telepon</p>
                                <p class="text-gray-900">{{ $order->phone_number ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600 mb-1">Catatan Pemesanan</p>
                            <span class="text-gray-900 whitespace-pre-line">{{ $order->customer_notes ?: '-' }}</span>
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

                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var select = document.getElementById('orderStatusSelect');
            var reasonWrap = document.getElementById('rejectionReasonWrap');
            if (!select) return;
            select.addEventListener('change', function() {
                if (this.value === 'rejected') {
                    reasonWrap.style.display = 'block';
                } else {
                    reasonWrap.style.display = 'none';
                }
            });
        });
    </script>
@endsection
