@extends('layouts.user')

@section('title', 'Promo')

@section('content')
    <!-- Hero Section -->
    <section class="py-16" style="background-color: #72BF78;">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Promo Spesial</h1>
                <p class="text-lg md:text-xl opacity-90 text-white">Dapatkan penawaran terbaik dari Dimsumlicious</p>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if ($promos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($promos as $promo)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Promo Image/Banner -->
                            <div class="relative h-48 bg-gray-300">
                                @if ($promo->banner_image)
                                    <img src="{{ asset('storage/' . $promo->banner_image) }}" alt="{{ $promo->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-gray-600 text-6xl">🎉</span>
                                    </div>
                                @endif

                                <!-- Discount Badge -->
                                <div
                                    class="absolute top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-full font-bold text-xl shadow-lg">
                                    {{ $promo->discount }}%
                                </div>
                            </div>

                            <!-- Promo Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $promo->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ $promo->description }}</p>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Berlaku: {{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                                    </div>

                                    @if ($promo->min_purchase > 0)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Min. Belanja: Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <a href="{{ route('user.products') }}"
                                        class="block text-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                                        Belanja Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $promos->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🎉</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Promo Aktif</h3>
                    <p class="text-gray-600">Maaf, saat ini belum ada promo yang tersedia. Silakan cek kembali nanti!</p>
                    <a href="{{ route('user.products') }}"
                        class="inline-block mt-6 bg-primary text-white px-8 py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                        Lihat Produk
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
