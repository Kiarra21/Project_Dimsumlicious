<!-- User Navbar -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo & Brand -->
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center bounce-gentle">
                    <img src="{{ asset('asset/foto/logo/dimsum.png') }}" class="w-12 h-12 rounded-full object-cover"
                        alt="Company Logo">
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-900">Dimsumlicious</h1>
                    <p class="text-xs text-gray-500">Dimsum Enak & Lezat</p>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Beranda
                </a>
                <a href="{{ route('user.products') }}"
                    class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Produk
                </a>
                <a href="{{ route('user.promo') }}"
                    class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Promo
                </a>
                <a href="{{ route('user.about') }}"
                    class="text-gray-700 hover:text-primary font-medium transition-colors duration-300">
                    Tentang & Kontak
                </a>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Cart with Badge -->
                    <a href="{{ route('cart.index') }}"
                        class="relative text-gray-700 hover:text-primary transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- User Menu (Authenticated) -->
                    <div class="hidden md:flex items-center space-x-3">
                        <div class="relative">
                            <button id="userMenuButton" onclick="toggleUserMenu(event)"
                                class="flex items-center space-x-2 focus:outline-none" aria-haspopup="true"
                                aria-expanded="false">
                                @if (auth()->user()->avatar)
                                    <img src="{{ asset('uploads/avatar/' . auth()->user()->avatar) }}"
                                        class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif

                                <span class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-600 transform transition-transform duration-200"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="userMenuDropdown"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden">

                                <a href="{{ route('user.profile.show') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <a href="{{ route('user.orders') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan Saya</a>

                                <div class="border-t my-1"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
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
            <a href="{{ route('home') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Beranda
            </a>
            <a href="{{ route('user.products') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Produk
            </a>
            <a href="{{ route('user.promo') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Promo
            </a>
            <a href="{{ route('user.about') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                Tentang & Kontak
            </a>

            @auth
                <div class="border-t border-gray-200 pt-3">
                    <a href="{{ route('cart.index') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                        🛒 Keranjang
                        @php
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="ml-2 px-2 py-0.5 bg-red-500 text-white text-xs rounded-full">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.orders') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-lg transition-colors duration-300">
                        📦 Pesanan Saya
                    </a>
                    <div class="flex items-center space-x-3 px-4 py-2 mt-2">
                        <div
                            class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
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
    <script>
        function toggleUserMenu(e) {
            e.stopPropagation();
            var btn = document.getElementById('userMenuButton');
            var menu = document.getElementById('userMenuDropdown');
            var chevron = btn ? btn.querySelector('svg') : null;
            if (!menu || !btn) return;
            var isHidden = menu.classList.contains('hidden');
            if (isHidden) {
                menu.classList.remove('hidden');
                btn.setAttribute('aria-expanded', 'true');
                if (chevron) chevron.classList.add('rotate-180');
            } else {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                if (chevron) chevron.classList.remove('rotate-180');
            }
        }

        document.addEventListener('click', function(e) {
            var menu = document.getElementById('userMenuDropdown');
            var btn = document.getElementById('userMenuButton');
            if (!menu || !btn) return;
            if (menu.classList.contains('hidden')) return;
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
                btn.setAttribute('aria-expanded', 'false');
                var chevron = btn.querySelector('svg');
                chevron && chevron.classList.remove('rotate-180');
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                var menu = document.getElementById('userMenuDropdown');
                var btn = document.getElementById('userMenuButton');
                if (!menu || menu.classList.contains('hidden')) return;
                menu.classList.add('hidden');
                btn && btn.setAttribute('aria-expanded', 'false');
                var chevron = btn && btn.querySelector('svg');
                chevron && chevron.classList.remove('rotate-180');
            }
        });
    </script>
</nav>
