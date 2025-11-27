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
