<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pinjaman Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk kawalan Sidebar (Mobile) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transition-transform duration-300 lg:static lg:translate-x-0 lg:flex lg:flex-col shadow-sm">
            <div class="flex items-center justify-center h-16 border-b border-slate-100">
                <span class="text-xl font-bold text-blue-600 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    e-Aset ICT
                </span>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                
                <!-- 1. Pautan Papan Pemuka -->
                <a href="{{ route('dashboard') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition-colors 
                {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Papan Pemuka
                </a>
                
                <!-- 2. Pautan Senarai Aset -->
                <a href="{{ route('assets.index') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition-colors 
                {{ request()->routeIs('assets.index') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Senarai Aset
                </a>

                <!-- 3. Pautan Daftar Aset Baru -->
                <a href="{{ route('assets.create') }}" 
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition-colors 
                {{ request()->routeIs('assets.create') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Daftar Aset Baru
                </a>
                
                <!-- 4. Pautan Senarai Permohonan -->
                <!-- Guna applications.* supaya ia kekal aktif bila berada di halaman Butiran (applications.show) -->
                <a href="{{ route('admin.loans.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition-colors 
                {{ request()->routeIs('applications.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Senarai Permohonan
                </a>

            </nav>

            <div class="p-4 border-t border-slate-100">
                <form method="POST" action="/logout">
                    <!-- @csrf -->
                    <button class="flex items-center gap-3 px-4 py-2 w-full text-left text-red-600 hover:bg-red-50 rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Log Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full">
            
            <!-- Top Navbar -->
            <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 z-10">
                <!-- Mobile Menu Button -->
                <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Search Bar (Optional) -->
                <div class="hidden md:flex relative w-96">
                    <input type="text" class="w-full bg-slate-50 border border-slate-200 text-sm rounded-full pl-10 pr-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cari aset (cth: Projektor, Laptop)...">
                    <svg class="w-4 h-4 absolute left-4 top-2.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>

                <!-- User Profile -->
                <div class="flex items-center gap-4 ml-auto">
                    <button class="relative text-slate-500 hover:text-blue-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4">
                        <img src="https://ui-avatars.com/api/?name=Admin+ICT&background=0D8ABC&color=fff" alt="User Avatar" class="w-8 h-8 rounded-full border border-slate-200">
                        <div class="hidden md:block">
                            <p class="text-sm font-semibold text-slate-700">Pentadbir Sistem</p>
                            <p class="text-xs text-slate-500">Unit ICT</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Dynamic Content (Blade Yield) -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6">
                @yield('content')
            </main>

        </div>
        
        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden" style="display: none;"></div>
    </div>

</body>
</html>