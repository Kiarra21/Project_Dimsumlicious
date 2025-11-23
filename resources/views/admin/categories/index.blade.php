@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
                <p class="text-sm sm:text-base text-gray-600 mt-1">Kelola kategori produk Dimsumlicious</p>
            </div>
            <button onclick="openAddModal()"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 font-medium flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="hidden sm:inline">Tambah Kategori</span>
                <span class="sm:hidden">Tambah</span>
            </button>
        </div>

        <!-- Search Bar -->
        <div class="mb-4">
            <form method="GET" action="{{ route('categories.index') }}" class="flex flex-col sm:flex-row gap-2">
                <div class="relative flex-1 sm:max-w-md">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
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
                    <a href="{{ route('categories.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 text-center">
                        Reset
                    </a>
                @endif
            </form>
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

        <!-- Categories Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->name }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary to-secondary flex items-center justify-center mr-3">
                                                <span
                                                    class="text-white font-bold text-lg">{{ substr($category->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-600">{{ Str::limit($category->description, 60) ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $category->products_count }} produk
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($category->is_active)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak
                                            Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button onclick='openEditModal(@json($category))'
                                        class="text-blue-600 hover:text-blue-800 mr-3">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    @if ($category->products_count == 0)
                                        <button onclick="deleteCategory({{ $category->id }})"
                                            class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @else
                                        <span class="text-gray-400 cursor-not-allowed"
                                            title="Tidak bisa dihapus karena masih memiliki produk">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <p class="mt-2">Belum ada kategori</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($categories->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('modals')
    <!-- Add/Edit Category Modal -->
    <div id="categoryModal" style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-lg max-w-lg w-full">
                <form id="categoryForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>

                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Kategori</h3>
                        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <!-- Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Kategori</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                            <div id="imagePreview" class="mt-2 hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-32 h-32 object-cover rounded-lg">
                            </div>
                        </div>

                        <!-- Is Active -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Kategori Aktif</span>
                            </label>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
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
                document.getElementById('modalTitle').textContent = 'Tambah Kategori';
                document.getElementById('categoryForm').action = '{{ route('categories.store') }}';
                document.getElementById('methodField').innerHTML = '';
                document.getElementById('categoryForm').reset();
                document.getElementById('imagePreview').classList.add('hidden');
                document.getElementById('categoryModal').style.display = 'flex';
            }

            function openEditModal(category) {
                document.getElementById('modalTitle').textContent = 'Edit Kategori';
                document.getElementById('categoryForm').action = '/categories/' + category.id;
                document.getElementById('methodField').innerHTML = '@method('PUT')';

                // Fill form
                document.querySelector('[name="name"]').value = category.name;
                document.querySelector('[name="description"]').value = category.description || '';
                document.querySelector('[name="is_active"]').checked = category.is_active;

                // Show existing image
                if (category.image) {
                    document.getElementById('previewImg').src = '/storage/' + category.image;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }

                document.getElementById('categoryModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('categoryModal').style.display = 'none';
            }

            function deleteCategory(id) {
                if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/categories/' + id;
                    form.innerHTML = '@csrf @method('DELETE')';
                    document.body.appendChild(form);
                    form.submit();
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
