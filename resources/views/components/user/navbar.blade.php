<!-- User Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center bounce-gentle">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Dimsumlicious</h1>
                    <p class="text-xs text-gray-500">Dimsum Enak & Lezat</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Beranda
                </a>
                <a href="#produk" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Produk
                </a>
                <a href="#promo" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Promo
                </a>
                <a href="#tentang" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Tentang Kami
                </a>
                <a href="#kontak" class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Kontak
                </a>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                <!-- Cart (Guest can view but need login to order) -->
                <button
                    class="relative text-gray-700 hover:text-primary transition-colors duration-300 hidden sm:block">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                </button>

                @auth
                    <!-- User Menu (Authenticated) -->
                    <div class="hidden md:flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <form action="{{ route('login') }}" method="GET" class="inline">
                                <button type="submit" class="text-xs text-red-600 hover:text-red-700">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}"
                        class="hidden md:inline-flex items-center px-5 py-2.5 bg-primary text-white rounded-full hover:bg-secondary transition-all duration-300 font-medium btn-animated">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Login
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200">
        <div class="px-4 py-4 space-y-3">
            <a href="#"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Beranda
            </a>
            <a href="#produk"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Produk
            </a>
            <a href="#promo"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Promo
            </a>
            <a href="#tentang"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Tentang Kami
            </a>
            <a href="#kontak"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Kontak
            </a>

            @auth
                <div class="border-t border-gray-200 pt-3">
                    <div class="flex items-center space-x-3 px-4 py-2">
                        <div
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <form action="{{ route('login') }}" method="GET" class="inline">
                                <button type="submit" class="text-xs text-red-600 hover:text-red-700">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="block px-4 py-2 bg-primary text-white text-center rounded-lg hover:bg-secondary transition-colors duration-300 font-medium">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
