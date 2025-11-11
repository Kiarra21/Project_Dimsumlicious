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
                            <svg class="w-48 h-48 mx-auto mb-4 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
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
                    Menu Pilihan Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Berbagai pilihan dimsum lezat dengan bahan berkualitas tinggi
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1 -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="h-56 bg-gradient-to-br from-[#72BF78] to-[#A0D683] flex items-center justify-center">
                        <svg class="w-32 h-32 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Dimsum Ayam</h3>
                            <span class="px-3 py-1 bg-[#A0D683] text-white rounded-full text-sm font-bold">Tersedia</span>
                        </div>
                        <p class="text-gray-600 mb-4">Dimsum ayam lezat dengan isian daging ayam pilihan</p>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-[#72BF78]">Rp 25.000</span>
                            <button
                                class="px-6 py-3 bg-[#72BF78] text-white rounded-lg hover:bg-[#A0D683] transition-colors duration-300 font-bold shadow-lg hover:shadow-xl">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="h-56 bg-gradient-to-br from-[#A0D683] to-[#D3EE98] flex items-center justify-center">
                        <svg class="w-32 h-32 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Dimsum Udang</h3>
                            <span class="px-3 py-1 bg-[#A0D683] text-white rounded-full text-sm font-bold">Tersedia</span>
                        </div>
                        <p class="text-gray-600 mb-4">Dimsum udang segar dengan tekstur kenyal</p>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-[#72BF78]">Rp 30.000</span>
                            <button
                                class="px-6 py-3 bg-[#72BF78] text-white rounded-lg hover:bg-[#A0D683] transition-colors duration-300 font-bold shadow-lg hover:shadow-xl">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div
                    class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-[#FEFF9F]">
                    <div class="h-56 bg-gradient-to-br from-[#D3EE98] to-[#FEFF9F] flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-700 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-[#FEFF9F]/20 to-white">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-2xl font-bold text-gray-900">Paket Hemat</h3>
                            <span class="px-3 py-1 bg-red-500 text-white rounded-full text-sm font-bold animate-pulse">🔥
                                Promo</span>
                        </div>
                        <p class="text-gray-600 mb-4">Paket isi 20 dimsum campur dengan harga spesial</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg text-gray-400 line-through">Rp 100.000</span>
                                <span class="text-3xl font-bold text-red-600 ml-2">Rp 85.000</span>
                            </div>
                            <button
                                class="px-6 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300 font-bold shadow-lg hover:shadow-xl">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#"
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Promo Card 1 -->
                <div
                    class="bg-gradient-to-br from-[#72BF78] to-[#A0D683] rounded-2xl p-8 text-white shadow-2xl transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-4 py-2 bg-white/30 backdrop-blur-sm rounded-full text-sm font-bold">Promo
                            Weekend</span>
                        <svg class="w-16 h-16 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-3 drop-shadow">Diskon 20%</h3>
                    <p class="text-lg mb-4 drop-shadow">Untuk semua jenis dimsum setiap akhir pekan</p>
                    <p class="text-sm font-semibold bg-white/20 inline-block px-4 py-2 rounded-full">📅 Berlaku sampai 31
                        Desember 2025</p>
                </div>

                <!-- Promo Card 2 -->
                <div
                    class="bg-gradient-to-br from-[#D3EE98] to-[#FEFF9F] rounded-2xl p-8 text-gray-900 shadow-2xl transform hover:scale-105 transition-all duration-300 border-4 border-[#A0D683]">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-4 py-2 bg-gray-900/10 backdrop-blur-sm rounded-full text-sm font-bold">Beli 2
                            Gratis 1</span>
                        <svg class="w-16 h-16 text-[#72BF78] drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-3 drop-shadow">Paket Ramadhan</h3>
                    <p class="text-lg mb-4 text-gray-800">Beli 2 paket hemat gratis 1 paket reguler</p>
                    <p class="text-sm font-semibold bg-gray-900/10 inline-block px-4 py-2 rounded-full">🌙 Berlaku setiap
                        hari selama bulan Ramadhan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                        Tentang Dimsumlicious
                    </h2>
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                        Dimsumlicious adalah penyedia dimsum berkualitas yang telah melayani ribuan pelanggan sejak tahun
                        2020. Kami berkomitmen untuk menyajikan dimsum dengan bahan-bahan pilihan dan cita rasa yang
                        otentik.
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
                            <p class="text-3xl font-bold drop-shadow-lg">Sejak 2020</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Hubungi Kami
                </h2>
                <p class="text-xl text-gray-600">
                    Kami siap melayani pesanan Anda!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- WhatsApp -->
                <a href="https://wa.me/6281234567890" target="_blank"
                    class="bg-white rounded-2xl p-8 text-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 border-4 border-green-500">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">WhatsApp</h3>
                    <p class="text-gray-600 mb-2 font-medium">Hubungi kami via WhatsApp</p>
                    <p class="text-green-600 font-bold text-lg">+62 812-3456-7890</p>
                </a>

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
                    <p class="text-blue-600 font-bold text-lg">+62 812-3456-7890</p>
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
                    <p class="text-purple-600 font-bold text-lg">info@dimsumlicious.com</p>
                </div>
            </div>
        </div>
    </section>
@endsection
