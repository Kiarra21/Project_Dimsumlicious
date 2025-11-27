{{-- blade-formatter-disable --}}
@extends('layouts.user')

@section('title', 'Tentang Kami')

@section('content')
    <!-- Hero Section -->
   <section 
    class="py-16 bg-cover bg-center bg-no-repeat relative"
    style="background-image: url('{{ asset('storage/' . $companyProfile['hero_image']) }}')">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Tentang Kami & Kontak</h1>
            <p class="text-lg md:text-xl text-white opacity-90">
                {{ $companyProfile['tagline'] }}
            </p>
        </div>
    </div>
    </section>


    <!-- About Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                        Tentang {{ $companyProfile->company_name ?? 'Dimsumlicious' }}
                    </h2>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        {{ $companyProfile->about_us ?? 'Dimsumlicious adalah penyedia dimsum berkualitas yang telah melayani ribuan pelanggan sejak tahun 2020. Kami berkomitmen untuk menyajikan dimsum dengan bahan-bahan pilihan dan cita rasa yang otentik.' }}
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-[#72BF78] rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-800 text-lg font-medium">Bahan berkualitas dan segar setiap hari</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-[#A0D683] rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-800 text-lg font-medium">Proses produksi higienis dan halal</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-[#72BF78] rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-800 text-lg font-medium">Harga terjangkau dengan kualitas premium</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <div
                                class="w-8 h-8 bg-[#A0D683] rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-800 text-lg font-medium">Pelayanan cepat dan ramah</span>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <div
                        class="w-full h-96 bg-gradient-to-br from-[#72BF78] to-[#A0D683] rounded-3xl shadow-2xl flex items-center justify-center border-8 border-white">
                        <div class="text-center text-white">
                            <svg class="w-48 h-48 mx-auto mb-4 drop-shadow-2xl" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            <p class="text-3xl font-bold drop-shadow-lg">Sejak {{ $companyProfile->founded_year ?? '2020' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Hubungi Kami
                </h2>
                <p class="text-xl text-gray-600">
                    Kami siap melayani pesanan Anda!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-16">
                <!-- Phone -->
                <div
                    class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-blue-500">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600 mb-2 font-medium">Hubungi via telepon</p>
                    <p class="text-blue-600 font-bold text-lg">{{ $companyProfile->phone ?? '+62 812-3456-7890' }}</p>
                </div>

                <!-- Email -->
                <div
                    class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-purple-500">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600 mb-2 font-medium">Kirim email kepada kami</p>
                    <p class="text-purple-600 font-bold text-lg">{{ $companyProfile->email ?? 'info@dimsumlicious.com' }}
                    </p>
                </div>
            </div>

            <!-- Social Media Section -->
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Media Sosial
                </h2>
                <p class="text-xl text-gray-600">
                    Ikuti kami di media sosial!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Instagram -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-pink-500">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Instagram</h3>
                    <p class="text-gray-600 mb-2 font-medium">Follow kami di Instagram</p>
                    <p class="text-pink-600 font-bold text-lg">{{ $companyProfile->instagram ?? 'dimsumlicious' }}</p>
                </div>

                <!-- TikTok -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-gray-900">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-gray-800 to-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">TikTok</h3>
                    <p class="text-gray-600 mb-2 font-medium">Follow kami di TikTok</p>
                    <p class="text-gray-900 font-bold text-lg">{{ $companyProfile->tiktok ?? 'dimsumlicious' }}</p>
                </div>

                <!-- Facebook -->
                <div class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-blue-600">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Facebook</h3>
                    <p class="text-gray-600 mb-2 font-medium">Follow kami di Facebook</p>
                    <p class="text-blue-600 font-bold text-lg">{{ $companyProfile->facebook ?? 'dimsumlicious' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Operating Hours Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Jam Operasional
                </h2>
                <p class="text-xl text-gray-600">
                    Kami siap melayani Anda
                </p>
            </div>

            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-2xl p-8 shadow-xl">
                    <div class="space-y-6">
                        <!-- Weekdays -->
                        <div class="flex items-center justify-between pb-6 border-b border-gray-200">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-[#72BF78] to-[#A0D683] rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Senin - Jumat</h3>
                                    <p class="text-gray-600">Hari Kerja</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-[#72BF78]">
                                    {{ $companyProfile->operating_hours_weekdays ?? '08:00 - 20:00' }}
                                </p>
                            </div>
                        </div>

                        <!-- Weekend -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Sabtu - Minggu</h3>
                                    <p class="text-gray-600">Akhir Pekan</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-blue-600">
                                    {{ $companyProfile->operating_hours_weekend ?? '09:00 - 21:00' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



































