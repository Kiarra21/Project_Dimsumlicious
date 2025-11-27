@extends('layouts.admin')

@section('title', 'Company Profile')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Company Profile</h1>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Kelola informasi profil perusahaan Dimsumlicious</p>
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

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                <strong class="block mb-2">Ada beberapa masalah saat menyimpan:</strong>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Last Update Info -->
        @if ($companyData['last_updated_by'])
            <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-3 mb-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm text-blue-700">
                        <strong>Terakhir diupdate oleh:</strong> {{ $companyData['last_updated_by'] }}
                    </span>
                </div>
                <span class="text-xs text-blue-600">
                    {{ $companyData['last_updated_at']->diffForHumans() }}
                </span>
            </div>
        @endif

        <!-- Company Profile Form -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">

            <form action="{{ route('company-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <br>
                {{-- Upload Images: Logo & Hero (side-by-side on md+) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="flex flex-col items-center text-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Logo Perusahaan</label>

                        @if ($companyData['logo'])
                            <img src="{{ asset('storage/' . $companyData['logo']) }}"
                                class="w-32 h-32 object-cover rounded-full mb-3 shadow">
                        @endif

                        <input type="file" name="logo" accept="image/*"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Banner / Hero Image</label>

                        @if ($companyData['hero_image'])
                            <img src="{{ asset('storage/' . $companyData['hero_image']) }}"
                                class="w-full max-w-md h-40 object-cover rounded-lg mb-3 shadow">
                        @endif

                        <input type="file" name="hero_image" accept="image/*"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Max 2MB)</p>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Basic Information Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Informasi Dasar
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Company Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                                <input type="text" name="company_name" value="{{ $companyData['name'] }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- Tagline -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                                <input type="text" name="tagline" value="{{ $companyData['tagline'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tentang Perusahaan</label>
                                <textarea name="description" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ $companyData['description'] }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Informasi Kontak
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Address -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="address" rows="2" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ $companyData['address'] }}</textarea>
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                                <input type="text" name="phone" value="{{ $companyData['phone'] }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- WhatsApp -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ $companyData['whatsapp'] }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ $companyData['email'] }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Operating Hours Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Jam Operasional
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Weekdays -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Senin - Jumat</label>
                                <input type="text" name="operating_hours_weekdays"
                                    value="{{ $companyData['operating_hours']['weekdays'] }}" placeholder="09:00 - 21:00"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- Weekend -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sabtu - Minggu</label>
                                <input type="text" name="operating_hours_weekend"
                                    value="{{ $companyData['operating_hours']['weekend'] }}" placeholder="08:00 - 22:00"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Media Sosial
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Instagram -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Instagram</label>
                                <input type="text" name="instagram"
                                    value="{{ $companyData['social_media']['instagram'] }}" placeholder="@dimsumlicious"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- Facebook -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                                <input type="text" name="facebook"
                                    value="{{ $companyData['social_media']['facebook'] }}"
                                    placeholder="Dimsumlicious Official"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>

                            <!-- TikTok -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">TikTok</label>
                                <input type="text" name="tiktok"
                                    value="{{ $companyData['social_media']['tiktok'] }}" placeholder="@dimsumlicious"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                    <button type="reset"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Reset
                    </button>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Company Information Preview -->
        <div class="mt-6 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Preview Informasi</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Nama Perusahaan</p>
                        <p class="text-base text-gray-900">{{ $companyData['name'] }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Alamat</p>
                        <p class="text-base text-gray-900">{{ $companyData['address'] }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Kontak</p>
                        <p class="text-base text-gray-900">{{ $companyData['phone'] }} | {{ $companyData['email'] }}</p>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Jam Operasional</p>
                        <p class="text-base text-gray-900">Senin-Jumat: {{ $companyData['operating_hours']['weekdays'] }}
                        </p>
                        <p class="text-base text-gray-900">Sabtu-Minggu: {{ $companyData['operating_hours']['weekend'] }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-500">Media Sosial</p>
                        <p class="text-base text-gray-900">IG: {{ $companyData['social_media']['instagram'] }}</p>
                        <p class="text-base text-gray-900">FB: {{ $companyData['social_media']['facebook'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
