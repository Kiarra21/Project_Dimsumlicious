@extends('layouts.user')

@section('title', 'Beranda - Dimsumlicious')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-[#72BF78] via-[#A0D683] to-[#72BF78] py-20 lg:py-32 overflow-hidden">
        <!-- Decorative circles -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-[#FEFF9F] opacity-20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#D3EE98] opacity-20 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Content -->
                <div class="text-white">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6 leading-tight drop-shadow-lg">
                        Dimsum Enak & Lezat
                        <span class="text-[#FEFF9F] drop-shadow-lg">Setiap Saat!</span>
                    </h1>
                    <p class="text-lg sm:text-xl mb-8 text-white drop-shadow">
                        Nikmati kelezatan dimsum dengan bahan berkualitas, dibuat segar setiap hari dengan resep spesial
                        kami.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#produk"
                            class="inline-flex items-center justify-center px-8 py-4 bg-white text-[#72BF78] rounded-full hover:bg-[#FEFF9F] hover:text-gray-900 transition-all duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Lihat Menu
                        </a>
                        <a href="https://wa.me/6281234567890?text=Halo%20Dimsumlicious" target="_blank"
                            class="inline-flex items-center justify-center px-8 py-4 bg-transparent border-2 border-white text-white rounded-full hover:bg-white hover:text-[#72BF78] transition-all duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                            Pesan Sekarang
                        </a>
                    </div>
                </div>

                <!-- Image/Illustration -->
                <div class="relative">
                    <div
                        class="w-full h-96 bg-white/20 backdrop-blur-sm rounded-3xl shadow-2xl flex items-center justify-center border-4 border-white/30">
                        <div class="text-center text-white">
                            <img src="{{ asset('asset/foto/logo/dimsum.png') }}" class="w-60 h-60 rounded-full object-cover"
                                alt="Company Logo">
                            <br>
                            <p class="text-2xl font-bold drop-shadow-lg">Dimsum Berkualitas</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center transform hover:scale-110 transition-transform duration-300">
                    <div class="text-5xl font-bold text-[#72BF78] mb-2 drop-shadow">500+</div>
                    <p class="text-gray-700 font-semibold">Pelanggan Puas</p>
                </div>
                <div class="text-center transform hover:scale-110 transition-transform duration-300">
                    <div class="text-5xl font-bold text-[#A0D683] mb-2 drop-shadow">50+</div>
                    <p class="text-gray-700 font-semibold">Menu Pilihan</p>
                </div>
                <div class="text-center transform hover:scale-110 transition-transform duration-300">
                    <div class="text-5xl font-bold text-[#72BF78] mb-2 drop-shadow">100%</div>
                    <p class="text-gray-700 font-semibold">Halal & Higienis</p>
                </div>
                <div class="text-center transform hover:scale-110 transition-transform duration-300">
                    <div class="text-5xl font-bold text-[#A0D683] mb-2 drop-shadow">4.8/5</div>
                    <p class="text-gray-700 font-semibold">Rating Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="produk" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Produk Unggulan
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Pilihan terbaik dimsum lezat dengan bahan berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProducts as $product)
                    <div
                        class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <!-- Product Image -->
                        <div class="h-56 bg-gradient-to-br from-[#72BF78] to-[#A0D683] overflow-hidden">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-white text-6xl">🥟</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                                @if ($product->stock > 0)
                                    <span
                                        class="px-3 py-1 bg-[#A0D683] text-white rounded-full text-sm font-bold">Tersedia</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-red-500 text-white rounded-full text-sm font-bold">Habis</span>
                                @endif
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-3xl font-bold text-[#72BF78]">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                                @auth
                                    @if (auth()->user()->role->name === 'user' && $product->stock > 0)
                                        <button
                                            onclick="openQtyModal({{ $product->id }}, '{{ $product->name }}', {{ $product->stock }})"
                                            class="px-6 py-3 bg-[#72BF78] text-white rounded-lg hover:bg-[#A0D683] transition-colors duration-300 font-bold shadow-lg hover:shadow-xl">
                                            Pesan
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="px-6 py-3 bg-[#72BF78] text-white rounded-lg hover:bg-[#A0D683] transition-colors duration-300 font-bold shadow-lg hover:shadow-xl">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-600 text-lg">Belum ada produk tersedia</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('user.products') }}"
                    class="inline-flex items-center px-10 py-4 bg-[#72BF78] text-white rounded-full hover:bg-[#A0D683] transition-colors duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                    Lihat Semua Menu
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <section id="promo" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Promo Spesial
                </h2>
                <p class="text-xl text-gray-600">
                    Jangan lewatkan promo menarik kami!
                </p>
            </div>

            @if ($latestPromos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    @foreach ($latestPromos as $promo)
                        <div
                            class="bg-white rounded-xl shadow-xl transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <!-- Gambar Promo -->
                            <div class="h-40 bg-[#A0D683] overflow-hidden">
                                @if ($promo->banner_image)
                                    <img src="{{ asset('storage/' . $promo->banner_image) }}" alt="{{ $promo->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-white text-6xl">🎉</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Konten Promo -->
                            <div class="p-6 bg-gradient-to-br from-[#72BF78] to-[#A0D683] text-white">
                                <h3 class="text-2xl font-bold mb-2 drop-shadow">{{ $promo->title }}</h3>
                                <p class="text-base mb-3 drop-shadow">{{ Str::limit($promo->description, 80) }}</p>
                                <p class="text-xs font-semibold bg-white/20 inline-block px-3 py-1 rounded-full">
                                    📅 Berlaku sampai {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg">Belum ada promo saat ini</p>
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('user.promo') }}"
                    class="inline-flex items-center px-10 py-4 bg-[#72BF78] text-white rounded-full hover:bg-[#A0D683] transition-colors duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105">
                    Lihat Semua Promo
                    <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Quantity Modal -->
    <div id="qtyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6 max-w-md w-full shadow-xl">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Masukkan Jumlah</h3>
            <p id="modalProductName" class="text-gray-600 mb-4"></p>

            <form id="addToCartForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                    <div class="flex items-center gap-3">
                        <button type="button" onclick="decrementQty()"
                            class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">
                            -
                        </button>
                        <input type="number" name="quantity" id="qtyInput" value="1" min="1"
                            class="w-20 text-center border border-gray-300 rounded-lg py-2 font-semibold">
                        <button type="button" onclick="incrementQty()"
                            class="w-10 h-10 bg-gray-200 hover:bg-gray-300 rounded-lg flex items-center justify-center font-bold">
                            +
                        </button>
                    </div>
                    <p id="stockInfo" class="text-xs text-gray-500 mt-1"></p>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeQtyModal()"
                        class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-semibold">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-[#72BF78] text-white rounded-lg hover:bg-[#A0D683] font-semibold">
                        Tambah ke Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStock = 1;

        function openQtyModal(productId, productName, stock) {
            currentStock = stock;
            document.getElementById('qtyModal').classList.remove('hidden');
            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('stockInfo').textContent = `Stok tersedia: ${stock}`;
            document.getElementById('qtyInput').value = 1;
            document.getElementById('qtyInput').max = stock;
            document.getElementById('addToCartForm').action = `/cart/add/${productId}`;
        }

        function closeQtyModal() {
            document.getElementById('qtyModal').classList.add('hidden');
        }

        function incrementQty() {
            const input = document.getElementById('qtyInput');
            const currentVal = parseInt(input.value);
            if (currentVal < currentStock) {
                input.value = currentVal + 1;
            }
        }

        function decrementQty() {
            const input = document.getElementById('qtyInput');
            const currentVal = parseInt(input.value);
            if (currentVal > 1) {
                input.value = currentVal - 1;
            }
        }

        // Close modal when clicking outside
        document.getElementById('qtyModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeQtyModal();
            }
        });
    </script>
@endsection
