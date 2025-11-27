@props(['status'])

@php
    $map = [
        'pending_payment' => ['text' => 'Menunggu Pembayaran', 'bg' => 'bg-red-100', 'textClass' => 'text-red-800'],
        'pending_cooking' => ['text' => 'Sedang Diproses', 'bg' => 'bg-yellow-100', 'textClass' => 'text-yellow-800'],
        'preparing' => ['text' => 'Disiapkan', 'bg' => 'bg-yellow-100', 'textClass' => 'text-yellow-800'],
        'ready' => ['text' => 'Siap Diambil', 'bg' => 'bg-blue-100', 'textClass' => 'text-blue-800'],
        'completed' => ['text' => 'Selesai', 'bg' => 'bg-green-100', 'textClass' => 'text-green-800'],
        'cancelled' => ['text' => 'Dibatalkan', 'bg' => 'bg-gray-100', 'textClass' => 'text-gray-800'],
        'rejected' => ['text' => 'Ditolak', 'bg' => 'bg-gray-100', 'textClass' => 'text-gray-800'],
    ];

    $s = $map[$status] ?? [
        'text' => ucfirst(str_replace('_', ' ', $status ?? 'unknown')),
        'bg' => 'bg-gray-100',
        'textClass' => 'text-gray-800',
    ];
@endphp

<span
    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $s['bg'] }} {{ $s['textClass'] }}">
    {{ $s['text'] }}
</span>
