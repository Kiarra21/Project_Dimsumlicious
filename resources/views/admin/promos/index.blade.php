@extends('layouts.admin')

@section('title', 'Manajemen Promosi')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Promosi</h1>
                <p class="text-sm sm:text-base text-gray-600 mt-1">Kelola promosi dan penawaran spesial Dimsumlicious</p>
            </div>
            <button onclick="openAddModal()"
                class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 font-medium flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="hidden sm:inline">Tambah Promosi</span>
                <span class="sm:hidden">Tambah</span>
            </button>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Promosi</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($promos) }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Promosi Aktif</p>
                        <p class="text-2xl font-bold text-green-600">
                            {{ collect($promos)->where('status', 'active')->count() }}</p>
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
                        <p class="text-gray-500 text-sm">Promosi Kadaluarsa</p>
                        <p class="text-2xl font-bold text-red-600">
                            {{ collect($promos)->where('status', 'expired')->count() }}</p>
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

        <!-- Promos Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($promos as $promo)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Promo Image -->
                    <div class="relative h-48 bg-gradient-to-br from-primary to-secondary">
                        <div class="absolute top-3 right-3">
                            @if ($promo['status'] === 'active')
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">Aktif</span>
                            @else
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-500 text-white">Kadaluarsa</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-20 h-20 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        @if ($promo['discount'] > 0)
                            <div class="absolute bottom-3 left-3">
                                <div class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg font-bold text-lg">
                                    {{ $promo['discount'] }}% OFF
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Promo Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $promo['title'] }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $promo['description'] }}</p>

                        <!-- Date Range -->
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($promo['start_date'])->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($promo['end_date'])->format('d M Y') }}</span>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <button onclick='openEditModal(@json($promo))'
                                class="flex-1 px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                Edit
                            </button>
                            @if (auth()->check() && auth()->user()->role->name === 'admin')
                                <button onclick="deletePromo({{ $promo['id'] }})"
                                    class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-md p-8 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <p class="mt-2 text-gray-500">Belum ada promosi</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('modals')
    <!-- Add/Edit Promo Modal -->
    <div id="promoModal" style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="bg-white rounded-lg">
                <form id="promoForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>

                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Promosi</h3>
                        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Judul Promosi *</label>
                            <input type="text" name="title" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                            <textarea name="description" rows="3" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <!-- Discount Percentage -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Diskon (%)</label>
                            <input type="number" name="discount" min="0" max="100" value="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Isi 0 jika tidak ada diskon persentase</p>
                        </div>

                        <!-- Date Range -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                                <input type="date" name="start_date" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                                <input type="date" name="end_date" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <!-- Banner Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Banner Promosi</label>
                            <input type="file" name="banner_image" accept="image/*" onchange="previewImage(event)"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                            <div id="imagePreview" class="mt-2 hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>
                        </div>

                        <!-- Status Active -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Promosi Aktif</span>
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
    </div>

    <script>
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Promosi';
            document.getElementById('promoForm').action = '{{ route('promos.store') }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('promoForm').reset();
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('promoModal').style.display = 'flex';
        }

        function openEditModal(promo) {
            document.getElementById('modalTitle').textContent = 'Edit Promosi';
            document.getElementById('promoForm').action = '/promos/' + promo.id;
            document.getElementById('methodField').innerHTML = '@method('PUT')';

            // Fill form
            document.querySelector('[name="title"]').value = promo.title;
            document.querySelector('[name="description"]').value = promo.description;
            document.querySelector('[name="discount"]').value = promo.discount;
            document.querySelector('[name="start_date"]').value = promo.start_date;
            document.querySelector('[name="end_date"]').value = promo.end_date;
            document.querySelector('[name="is_active"]').checked = promo.status === 'active';

            // Show existing image if available
            if (promo.image) {
                document.getElementById('previewImg').src = '/storage/' + promo.image;
                document.getElementById('imagePreview').classList.remove('hidden');
            }

            document.getElementById('promoModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('promoModal').style.display = 'none';
        }

        function deletePromo(id) {
            if (confirm('Apakah Anda yakin ingin menghapus promosi ini?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/promos/' + id;
                form.innerHTML = '@csrf @method('DELETE')';
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Image preview
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
