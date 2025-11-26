@extends('layouts.user')

@section('title', 'Produk Kami')

@section('content')
    <!-- Hero Section -->
    <section class="py-16" style="background-color: #72BF78;">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Produk Kami</h1>
                <p class="text-lg md:text-xl opacity-90 text-white">Nikmati kelezatan dimsum autentik pilihan terbaik</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Filter Section -->
            <div class="mb-8 flex flex-wrap gap-4 items-center justify-between">
                <div>
                    <p class="text-gray-600">Menampilkan <span class="font-semibold">{{ $products->count() }}</span> dari
                        <span class="font-semibold">{{ $products->total() }}</span> produk
                    </p>
                </div>

                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('user.products') }}"
                        class="px-4 py-2 rounded-lg {{ !request('category') ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('user.products', ['category' => $category->id]) }}"
                            class="px-4 py-2 rounded-lg {{ request('category') == $category->id ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Products Grid -->
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Product Image -->
                            <div class="relative h-48 bg-gray-200 overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                        <span class="text-gray-600 text-5xl">🥟</span>
                                    </div>
                                @endif

                                <!-- Stock Badge -->
                                @if ($product->stock <= 0)
                                    <div
                                        class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        Habis
                                    </div>
                                @elseif($product->stock < 10)
                                    <div
                                        class="absolute top-2 right-2 bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                        Stok Terbatas
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <div class="mb-2">
                                    <span
                                        class="inline-block bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-2xl font-bold text-primary">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p class="text-xs text-gray-500">Stok: {{ $product->stock }}</p>
                                    </div>

                                    @auth
                                        @if (auth()->user()->role->name === 'user')
                                            @if ($product->stock > 0)
                                                <button
                                                    onclick="openQtyModal({{ $product->id }}, '{{ $product->name }}', {{ $product->stock }})"
                                                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors text-sm font-semibold">
                                                    + Keranjang
                                                </button>
                                            @else
                                                <button disabled
                                                    class="bg-gray-300 text-gray-500 px-4 py-2 rounded-lg cursor-not-allowed text-sm font-semibold">
                                                    Habis
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors text-sm font-semibold">
                                            Login
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🥟</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-600">Maaf, tidak ada produk yang tersedia saat ini.</p>
                </div>
            @endif
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
                        class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 font-semibold">
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
