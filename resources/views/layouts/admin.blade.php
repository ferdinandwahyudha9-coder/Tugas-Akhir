<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Nand Second</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile Header -->
    <div class="md:hidden flex items-center justify-between bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 sticky top-0 z-30">
        <div class="flex items-center gap-2">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <div class="flex flex-col ml-1">
                <span class="font-bold text-lg text-gray-900 dark:text-white tracking-wide">⚡ Admin Panel</span>
                <span class="text-[0.65rem] text-gray-500 dark:text-gray-400 uppercase tracking-wider leading-none">Nand Second</span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="toggleDarkMode()" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition">
                <!-- Moon Icon (for Light Mode) -->
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                <!-- Sun Icon (for Dark Mode) -->
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </button>
             <div class="flex items-center gap-2 cursor-pointer" onclick="window.location.href='{{ route('profil') }}'">
                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <!-- <span class="text-sm font-medium text-gray-700 hidden md:block">{{ Auth::user()->name }}</span> -->
             </div>
        </div>
    </div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col border-r border-gray-200 dark:border-gray-700 shadow-sm"
        >
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold tracking-wide text-gray-900 dark:text-white">⚡ Admin Panel</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nand Second</p>
                </div>
                <!-- Close Button for Mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div role="navigation" class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.index') }}" 
                           class="flex items-center px-6 py-3 border-l-4 transition-colors {{ request()->routeIs('admin.index') ? 'bg-blue-50 border-blue-600 text-blue-700 font-medium dark:bg-blue-900/20 dark:border-blue-500 dark:text-blue-400' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700/30 dark:hover:border-gray-600 dark:hover:text-gray-200' }}">
                            <span class="mr-3 {{ request()->routeIs('admin.index') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">▸</span>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}" 
                           class="flex items-center px-6 py-3 border-l-4 transition-colors {{ request()->routeIs('admin.users') ? 'bg-blue-50 border-blue-600 text-blue-700 font-medium dark:bg-blue-900/20 dark:border-blue-500 dark:text-blue-400' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700/30 dark:hover:border-gray-600 dark:hover:text-gray-200' }}">
                            <span class="mr-3 {{ request()->routeIs('admin.users') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">▸</span>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.produk') }}" 
                           class="flex items-center px-6 py-3 border-l-4 transition-colors {{ request()->routeIs('admin.produk') ? 'bg-blue-50 border-blue-600 text-blue-700 font-medium dark:bg-blue-900/20 dark:border-blue-500 dark:text-blue-400' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700/30 dark:hover:border-gray-600 dark:hover:text-gray-200' }}">
                            <span class="mr-3 {{ request()->routeIs('admin.produk') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">▸</span>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pesanan') }}" 
                           class="flex items-center px-6 py-3 border-l-4 transition-colors {{ request()->routeIs('admin.pesanan') || request()->routeIs('admin.pesanan.*') ? 'bg-blue-50 border-blue-600 text-blue-700 font-medium dark:bg-blue-900/20 dark:border-blue-500 dark:text-blue-400' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700/30 dark:hover:border-gray-600 dark:hover:text-gray-200' }}">
                            <span class="mr-3 {{ request()->routeIs('admin.pesanan') || request()->routeIs('admin.pesanan.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400 dark:text-gray-500' }}">▸</span>
                            Pesanan
                        </a>
                    </li>
                </ul>
            </div>

            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-3 mb-4 px-2">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ Auth::user()->name }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                     <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-gray-50 dark:bg-gray-700/50 hover:bg-red-50 dark:hover:bg-red-900/20 text-gray-600 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 border border-gray-200 dark:border-gray-600 hover:border-red-200 dark:hover:border-red-800 rounded-lg transition-colors text-sm font-medium gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
            x-cloak
        ></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900 h-full w-full">
            
            <!-- Desktop Navbar -->
            <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20 px-8 py-4 hidden md:flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-4">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">@yield('title', 'Admin Panel')</h2>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 transition" title="Toggle Dark Mode">
                        <!-- Moon Icon -->
                        <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <!-- Sun Icon -->
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <!-- Profile Dropdown (Simple) -->
                    <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='{{ route('profil') }}'">
                        <div class="text-right hidden lg:block">
                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white dark:ring-gray-800">
                             {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-6 md:p-8 flex-1">
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        @yield('header')
                    </div>
                    <div class="flex gap-3">
                        @yield('actions')
                    </div>
                </div>

                @yield('content')
            </div>
            
            <footer class="mt-auto py-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Nand Second. All rights reserved.
            </footer>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
