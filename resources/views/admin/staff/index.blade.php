@extends('layouts.admin')

@section('title', 'Manajemen Staff')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header & Stats -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Staff</h1>
                    <p class="text-sm sm:text-base text-gray-600 mt-1">Kelola data staff Dimsumlicious</p>
                </div>
                <button onclick="openAddModal()"
                    class="px-4 sm:px-6 py-2 sm:py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 font-medium flex items-center justify-center gap-2 text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">Tambah Staff</span>
                    <span class="sm:hidden">Tambah</span>
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Staff</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_staff'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Staff Aktif</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['active_staff'] }}</p>
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
                            <p class="text-gray-500 text-sm">Tidak Aktif</p>
                            <p class="text-2xl font-bold text-red-600">{{ $stats['inactive_staff'] }}</p>
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
                <form method="GET" action="{{ route('staff.index') }}" class="flex flex-col sm:flex-row gap-2">
                    <div class="relative flex-1 sm:max-w-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari staff..."
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
                        <a href="{{ route('staff.index') }}"
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

        <!-- Staff Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Staff</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($staffList as $staff)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($staff->avatar)
                                            <img src="{{ asset('storage/' . $staff->avatar) }}" alt="{{ $staff->name }}"
                                                class="w-12 h-12 rounded-full object-cover mr-3">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-full bg-primary flex items-center justify-center mr-3">
                                                <span
                                                    class="text-white font-bold text-lg">{{ substr($staff->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $staff->name }}</div>
                                            <div class="text-sm text-gray-500">Bergabung
                                                {{ $staff->created_at->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $staff->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $staff->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($staff->is_active)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Tidak
                                            Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button onclick='openEditModal(@json($staff))'
                                        class="text-blue-600 hover:text-blue-800 mr-3">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="deleteStaff({{ $staff->id }})"
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
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="mt-2">Belum ada data staff</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($staffList->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $staffList->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('modals')
    <!-- Add/Edit Staff Modal -->
    <div id="staffModal" style="display: none;"
        class="fixed inset-0 bg-black bg-opacity-50 z-[9999] flex items-center justify-center p-4">
        <div class="w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <form id="staffForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>

                    <div
                        class="px-6 py-4 border-b border-gray-200 flex justify-between items-center sticky top-0 bg-white">
                        <h3 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Staff</h3>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password <span
                                    id="passwordOptional" class="text-gray-500 text-xs">(Kosongkan jika tidak ingin
                                    mengubah)</span></label>
                            <input type="password" name="password" id="passwordField"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                            <input type="text" name="phone"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <!-- Address -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="address" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <!-- Avatar -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                            <input type="file" name="avatar" accept="image/*" onchange="previewAvatar(event)"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                            <div id="avatarPreview" class="mt-2 hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="w-32 h-32 object-cover rounded-full">
                            </div>
                        </div>

                        <!-- Status Active -->
                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
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
                document.getElementById('modalTitle').textContent = 'Tambah Staff';
                document.getElementById('staffForm').action = '{{ route('staff.store') }}';
                document.getElementById('methodField').innerHTML = '';
                document.getElementById('staffForm').reset();
                document.getElementById('avatarPreview').classList.add('hidden');
                document.getElementById('passwordField').required = true;
                document.getElementById('passwordOptional').classList.add('hidden');
                document.getElementById('staffModal').style.display = 'flex';
            }

            function openEditModal(staff) {
                document.getElementById('modalTitle').textContent = 'Edit Staff';
                document.getElementById('staffForm').action = '/staff/' + staff.id;
                document.getElementById('methodField').innerHTML = '@method('PUT')';

                // Fill form
                document.querySelector('[name="name"]').value = staff.name;
                document.querySelector('[name="email"]').value = staff.email;
                document.querySelector('[name="phone"]').value = staff.phone || '';
                document.querySelector('[name="address"]').value = staff.address || '';
                document.querySelector('[name="is_active"]').checked = staff.is_active;

                // Password optional for edit
                document.getElementById('passwordField').required = false;
                document.getElementById('passwordOptional').classList.remove('hidden');

                // Show existing avatar
                if (staff.avatar) {
                    document.getElementById('previewImg').src = '/storage/' + staff.avatar;
                    document.getElementById('avatarPreview').classList.remove('hidden');
                }

                document.getElementById('staffModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('staffModal').style.display = 'none';
            }

            function deleteStaff(id) {
                if (confirm('Apakah Anda yakin ingin menghapus staff ini?')) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/staff/' + id;
                    form.innerHTML = '@csrf @method('DELETE')';
                    document.body.appendChild(form);
                    form.submit();
                }
            }

            // Avatar preview
            function previewAvatar(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('avatarPreview').classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    @endpush
