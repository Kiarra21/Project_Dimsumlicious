@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header & Stats -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Produk</h1>
                    <p class="text-sm sm:text-base text-gray-600 mt-1">Kelola semua produk Dimsumlicious</p>
                </div>
                <button onclick="openAddModal()"
                    class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 font-medium flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">Tambah Produk</span>
                    <span class="sm:hidden">Tambah</span>
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Produk</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_products'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Tersedia</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['available_products'] }}</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Stok Menipis</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $stats['low_stock_products'] }}</p>
                        </div>
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Habis</p>
                            <p class="text-2xl font-bold text-red-600">{{ $stats['out_of_stock'] }}</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-4 mt-4">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-2">
                    <div class="relative flex-1 sm:max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-opacity-90">
                        Cari
                    </button>
                    @if (request('search'))
                        <a href="{{ route('products.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 text-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="w-12 h-12 rounded-lg object-cover mr-3">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center mr-3">
                                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ $product->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">
                                        @if ($product->has_discount && $product->discount_price)
                                            <div class="flex flex-col">
                                                <span class="text-xs text-gray-400 line-through">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </span>
                                                <span class="text-green-600">
                                                    Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @else
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($product->stock == 0)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                                    @elseif($product->stock <= 5)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $product->stock }}
                                            pcs</span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $product->stock }}
                                            pcs</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($product->is_available)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak
                                            Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button onclick='openEditModal(@json($product))'
                                        class="text-blue-600 hover:text-blue-800 mr-3">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="deleteProduct({{ $product->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="mt-2">Belum ada produk</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('modals')
    <!-- Add/Edit Product Modal -->
    <div id="productModal" style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <form id="productForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>

                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Produk</h3>
                        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                            <select name="category_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk *</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <!-- Price & Stock -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga *</label>
                                <input type="number" name="price" required min="0" id="productPrice"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                    onchange="calculateDiscount()">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Stok *</label>
                                <input type="number" name="stock" required min="0"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <!-- Promo Discount -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Promo (Opsional)</label>
                            <select name="promo_id" id="productPromo" onchange="calculateDiscount()"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Tanpa Promo</option>
                                @foreach ($promos as $promo)
                                    <option value="{{ $promo->id }}" data-discount="{{ $promo->discount }}">
                                        {{ $promo->title }} ({{ $promo->discount }}% OFF)
                                    </option>
                                @endforeach
                            </select>
                            <div id="discountInfo" class="hidden mt-2 p-3 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-sm text-green-700">
                                    <strong>Harga Asli:</strong> Rp <span id="originalPrice">0</span><br>
                                    <strong>Diskon:</strong> <span id="discountPercent">0</span>%<br>
                                    <strong>Harga Setelah Diskon:</strong> Rp <span id="finalPrice"
                                        class="font-bold">0</span>
                                </p>
                            </div>
                        </div>

                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                            <div id="imagePreview" class="mt-2 hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        </div>

                        <!-- Checkboxes -->
                        <div class="flex gap-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_available" value="1" checked
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Tersedia</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1"
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Produk Unggulan</span>
                            </label>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3 sticky bottom-0 bg-white">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openAddModal() {
                document.getElementById('modalTitle').textContent = 'Tambah Produk';
                document.getElementById('productForm').action = '{{ route('products.store') }}';
                document.getElementById('methodField').innerHTML = '';
                document.getElementById('productForm').reset();
                document.getElementById('imagePreview').classList.add('hidden');
                document.getElementById('discountInfo').classList.add('hidden');
                document.getElementById('productModal').style.display = 'flex';
            }

            function openEditModal(product) {
                document.getElementById('modalTitle').textContent = 'Edit Produk';
                document.getElementById('productForm').action = '/admin/products/' + product.id;
                document.getElementById('methodField').innerHTML = '@method('PUT')';

                // Fill form
                document.querySelector('[name="category_id"]').value = product.category_id;
                document.querySelector('[name="name"]').value = product.name;
                document.querySelector('[name="description"]').value = product.description || '';
                document.querySelector('[name="price"]').value = product.price;
                document.querySelector('[name="stock"]').value = product.stock;
                document.querySelector('[name="promo_id"]').value = product.promo_id || '';
                document.querySelector('[name="is_available"]').checked = product.is_available;
                document.querySelector('[name="is_featured"]').checked = product.is_featured;

                // Show existing image
                if (product.image) {
                    document.getElementById('previewImg').src = '/storage/' + product.image;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }

                // Calculate and show discount if promo exists
                calculateDiscount();

                document.getElementById('productModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('productModal').style.display = 'none';
            }

            function deleteProduct(id) {
                if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/admin/products/' + id;
                    form.innerHTML = '@csrf @method('DELETE')';
                    document.body.appendChild(form);
                    form.submit();
                }
            }

            function calculateDiscount() {
                const priceInput = document.getElementById('productPrice');
                const promoSelect = document.getElementById('productPromo');
                const discountInfo = document.getElementById('discountInfo');

                const price = parseFloat(priceInput.value) || 0;
                const selectedOption = promoSelect.options[promoSelect.selectedIndex];
                const discount = parseFloat(selectedOption.getAttribute('data-discount')) || 0;

                if (price > 0 && discount > 0) {
                    const discountAmount = price * discount / 100;
                    const finalPrice = price - discountAmount;

                    document.getElementById('originalPrice').textContent = price.toLocaleString('id-ID');
                    document.getElementById('discountPercent').textContent = discount;
                    document.getElementById('finalPrice').textContent = finalPrice.toLocaleString('id-ID');
                    discountInfo.classList.remove('hidden');
                } else {
                    discountInfo.classList.add('hidden');
                }
            }

            // Image preview
            document.querySelector('[name="image"]').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
