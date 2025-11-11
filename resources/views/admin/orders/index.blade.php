@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pesanan</h1>
                <p class="text-gray-600 mt-1">Kelola semua pesanan pelanggan</p>
            </div>
        </div>

        <!-- Status Filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('orders.index') }}"
                    class="px-4 py-2 rounded-lg {{ !request('status') || request('status') == 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Semua ({{ $statusCounts['all'] ?? 0 }})
                </a>
                <a href="{{ route('orders.index', ['status' => 'pending_payment']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'pending_payment' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Menunggu Pembayaran ({{ $statusCounts['pending_payment'] ?? 0 }})
                </a>
                <a href="{{ route('orders.index', ['status' => 'pending_cooking']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'pending_cooking' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Sedang Diproses ({{ $statusCounts['pending_cooking'] ?? 0 }})
                </a>
                <a href="{{ route('orders.index', ['status' => 'completed']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'completed' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Selesai ({{ $statusCounts['completed'] ?? 0 }})
                </a>
                <a href="{{ route('orders.index', ['status' => 'rejected']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'rejected' ? 'bg-gray-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Ditolak ({{ $statusCounts['rejected'] ?? 0 }})
                </a>
            </div>

            <!-- Search -->
            <form method="GET" action="{{ route('orders.index') }}" class="mt-4">
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nomor pesanan atau nama customer..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor
                            Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="font-mono text-sm font-semibold text-gray-900">{{ $order->order_number }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-gray-900">Rp
                                    {{ number_format($order->total, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($order->status == 'pending_payment')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Menunggu Pembayaran
                                    </span>
                                @elseif($order->status == 'pending_cooking')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Sedang Diproses
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="text-primary hover:text-opacity-80 font-medium">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                <p class="mt-2">Belum ada pesanan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($orders->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
