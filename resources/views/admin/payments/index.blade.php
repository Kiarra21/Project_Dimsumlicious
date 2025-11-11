@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pembayaran</h1>
                <p class="text-gray-600 mt-1">Verifikasi bukti pembayaran pelanggan</p>
            </div>
        </div>

        <!-- Status Filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('payments.index') }}"
                    class="px-4 py-2 rounded-lg {{ !request('status') || request('status') == 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua ({{ $statusCounts['all'] ?? 0 }})
                </a>
                <a href="{{ route('payments.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'pending' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Menunggu Verifikasi ({{ $statusCounts['pending'] ?? 0 }})
                </a>
                <a href="{{ route('payments.index', ['status' => 'verified']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'verified' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Terverifikasi ({{ $statusCounts['verified'] ?? 0 }})
                </a>
                <a href="{{ route('payments.index', ['status' => 'rejected']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Ditolak ({{ $statusCounts['rejected'] ?? 0 }})
                </a>
            </div>

            <!-- Search -->
            <form method="GET" action="{{ route('payments.index') }}" class="mt-4">
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nomor pesanan..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Payments Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor
                            Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="font-mono text-sm font-semibold text-gray-900">{{ $payment->order->order_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $payment->order->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">Rp
                                    {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                    {{ strtoupper($payment->payment_method) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($payment->status == 'pending')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($payment->status == 'verified')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $payment->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('payments.show', $payment->id) }}"
                                    class="text-primary hover:text-opacity-80 font-medium">
                                    Lihat Bukti
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                <p class="mt-2">Belum ada pembayaran</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($payments->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
