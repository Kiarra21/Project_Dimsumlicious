<!-- Sidebar -->
<aside id="sidebar"
    class="w-64 bg-white shadow-xl sidebar-transition sidebar-closed md:sidebar-open fixed md:relative h-full z-40">
    <div class="h-full flex flex-col">
        <!-- Logo & Brand -->
        <div class="flex items-center justify-center h-20 border-b border-gray-200 bg-primary">
            <div class="flex items-center space-x-3 px-4">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">Dimsumlicious</h1>
                    <p class="text-white text-xs opacity-90">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto py-4">
            <div class="px-4 space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Manajemen Produk -->
                <a href="{{ route('products.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('products.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="font-medium">Produk</span>
                </a>

                <!-- Kategori Produk -->
                <a href="{{ route('categories.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('categories.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span class="font-medium">Kategori</span>
                </a>

                <!-- Divider Section -->
                <div class="pt-2 pb-1">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pemesanan</p>
                </div>

                <!-- Pesanan/Orders -->
                <a href="{{ route('orders.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('orders.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <span class="font-medium">Pesanan</span>
                    @php
                        $pendingOrders = \App\Models\Order::where('status', 'pending_payment')->count();
                    @endphp
                    @if ($pendingOrders > 0)
                        <span
                            class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingOrders }}</span>
                    @endif
                </a>

                <!-- Pembayaran/Payments -->
                <a href="{{ route('payments.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('payments.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="font-medium">Pembayaran</span>
                    @php
                        $pendingPayments = \App\Models\Payment::where('status', 'pending')->count();
                    @endphp
                    @if ($pendingPayments > 0)
                        <span
                            class="ml-auto bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingPayments }}</span>
                    @endif
                </a>

                <!-- Divider Section -->
                <div class="pt-2 pb-1">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Manajemen</p>
                </div>

                <!-- Staff Management (Admin Only) -->
                @if (($role ?? 'admin') === 'admin')
                    <a href="{{ route('staff.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('staff.*') ? 'bg-primary text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="font-medium">Manajemen Staff</span>
                    </a>
                @endif

                <!-- Laporan Penjualan -->
                <a href="{{ route('reports.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('reports.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-medium">Laporan</span>
                    @if (($role ?? 'admin') === 'staff')
                        <span class="ml-auto text-xs bg-gray-200 text-gray-600 px-2 py-1 rounded">View Only</span>
                    @endif
                </a>

                <!-- Promosi -->
                <a href="{{ route('promos.index') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('promos.*') ? 'bg-primary text-white' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    <span class="font-medium">Promosi</span>
                </a>

                <!-- Company Profile (Admin Only) -->
                @if (($role ?? 'admin') === 'admin')
                    <a href="{{ route('company-profile.index') }}"
                        class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300 {{ request()->routeIs('company-profile.*') ? 'bg-primary text-white' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="font-medium">Company Profile</span>
                    </a>
                @endif
            </div>

            <!-- Divider -->
            <div class="my-4 px-4">
                <div class="border-t border-gray-200"></div>
            </div>

            <!-- Other Menu -->
            <div class="px-4 space-y-1">
                <a href="{{ route('profile.show') }}"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-medium">Profile</span>
                </a>

                <a href="#"
                    class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-primary hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="font-medium">Pengaturan</span>
                </a>
            </div>
        </nav>

        <!-- User Info -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($username ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $username ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst($role ?? 'admin') }}</p>
                </div>
                <form action="{{ route('login') }}" method="GET">
                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors duration-300"
                        title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>
