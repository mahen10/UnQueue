<!DOCTYPE html>
<html lang="id" class="bg-[#F8FAFC]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnQueue - @yield('title', 'Owner Dashboard')</title>
    
    <!-- Tailwind CSS (CDN for development due to Node version issue) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link { transition: all 0.2s ease-in-out; }
        .sidebar-link.active { background-color: #F3F4F6; color: #111827; font-weight: 600; }
        .sidebar-link.active svg { color: #3B82F6; }
    </style>
</head>
<body class="text-gray-900 antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full flex-shrink-0 relative z-20 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
        <!-- Logo -->
        <div class="h-20 flex items-center px-8">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-900 flex items-center gap-3 tracking-tight">
                <div class="relative w-6 h-6">
                    <!-- Colorful abstract logo similar to reference -->
                    <div class="absolute top-0 left-0 w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                    <div class="absolute top-0 right-0 w-2.5 h-2.5 rounded-full bg-purple-500"></div>
                    <div class="absolute bottom-0 left-0 w-2.5 h-2.5 rounded-full bg-orange-500"></div>
                    <div class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-pink-500"></div>
                </div>
                UnQueue
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Analytics
            </a>

            <a href="{{ route('admin.menu-items.index') }}" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Products
            </a>

            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Categories
            </a>

            <a href="{{ route('admin.tables.index') }}" class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50 {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"></path></svg>
                Tables
            </a>

            <!-- Reports will be added here later when Admin Reports are implemented -->

            <form method="POST" action="{{ route('logout') }}" class="w-full px-2">
                @csrf
                <button type="submit" class="w-full sidebar-link flex items-center gap-4 px-2 py-3 rounded-xl text-sm font-medium text-gray-500 hover:text-red-600 hover:bg-red-50 text-left transition">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Sign Out
                </button>
            </form>
            
            <!-- Help Box Illustration -->
            <div class="mt-8 mx-4 p-5 bg-[#EEF2FF] rounded-2xl flex flex-col items-center text-center relative overflow-hidden group hover:shadow-sm transition border border-indigo-50">
                <div class="w-16 h-16 mb-3 bg-white rounded-full flex items-center justify-center text-indigo-500 shadow-sm border border-indigo-100 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <p class="text-[13px] font-bold text-indigo-900 mb-1">Need help?</p>
                <p class="text-[11px] font-medium text-indigo-600/80 mb-4">Feel free to contact us</p>
                <a href="#" class="w-full bg-indigo-600 text-white text-[11px] font-bold py-2.5 px-4 rounded-xl hover:bg-indigo-700 transition shadow-sm hover:shadow-md">Get Support</a>
            </div>
            
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full overflow-hidden">
        <!-- Top Header for User Profile -->
        <header class="h-20 bg-[#F8FAFC] flex items-center justify-end px-8 flex-shrink-0 z-10">
            <div class="flex items-center gap-6">
                <!-- Theme toggle placeholder -->
                <div class="flex items-center gap-4 text-gray-400">
                    <button class="hover:text-blue-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>
                    <button class="hover:text-gray-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>
                </div>
                
                <div class="w-px h-6 bg-gray-200"></div>

                <!-- User Profile -->
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 border border-indigo-200 overflow-hidden shadow-sm">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=E0E7FF&color=3730A3&bold=true" alt="Profile" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[13px] font-bold text-gray-900 group-hover:text-blue-600 transition">{{ Auth::user()->name }}</span>
                        <span class="text-[11px] font-medium text-gray-500">{{ Auth::user()->uq_id }}</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Content Area -->
        <div class="flex-1 overflow-y-auto px-8 pb-8 custom-scrollbar">
            @if (session('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm flex items-center gap-2 border border-red-100 mb-6 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="animate-fade-in-up">
                @yield('content')
            </div>
        </div>
    </main>

    <style>
        /* Custom Scrollbar for inner content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #CBD5E1;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94A3B8;
        }
        
        /* Fade in up animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.4s ease-out forwards;
        }
    </style>
</body>
</html>
