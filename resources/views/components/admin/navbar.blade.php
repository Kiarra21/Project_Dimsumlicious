<!-- Admin Navbar -->
<header class="bg-white shadow-sm h-20 flex items-center px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between w-full">
        <!-- Mobile Menu Button & Page Title -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Sidebar Toggle -->
            <button onclick="toggleSidebar()" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Page Title -->
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                <p class="text-xs sm:text-sm text-gray-500">@yield('page-subtitle', 'Kelola bisnis dimsum Anda')</p>
            </div>
        </div>

        <!-- Right Side Actions -->
        <div class="flex items-center space-x-3 sm:space-x-4">
            <!-- Search (Hidden on mobile) -->
            <div class="hidden lg:block relative">
                <input type="text" placeholder="Cari produk..."
                    class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Notifications -->
            <button class="relative text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
            </button>

            <!-- Quick Actions Dropdown -->
            <div class="relative hidden sm:block">
                <button
                    class="flex items-center space-x-2 px-3 py-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="text-sm font-medium hidden lg:inline">Tambah Produk</span>
                </button>
            </div>

            <!-- User Menu (Mobile) -->
            <div class="md:hidden">
                <button
                    class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr($username ?? 'A', 0, 1)) }}
                </button>
            </div>
        </div>
    </div>
</header>
