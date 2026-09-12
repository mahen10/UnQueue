<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UnQueue - @yield('title')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
        .dark-theme ::-webkit-scrollbar-thumb { background-color: #475569; }
    </style>
    @stack('styles')
</head>
<body class="flex flex-col min-h-screen antialiased transition-colors duration-200 {{ isset($darkMode) && $darkMode ? 'bg-slate-900 text-slate-100 dark-theme' : 'bg-slate-50 text-slate-900' }}">

    <!-- Top Navbar -->
    <header class="h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 shadow-sm sticky top-0 z-50 border-b transition-colors duration-200 {{ isset($darkMode) && $darkMode ? 'bg-slate-800 border-slate-700' : 'bg-white border-slate-200' }}">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-indigo-600/20 shrink-0">
                UQ
            </div>
            <div>
                <h1 class="font-bold text-lg leading-tight {{ isset($darkMode) && $darkMode ? 'text-white' : 'text-slate-900' }}">@yield('header_title', 'Operasional')</h1>
                <p class="text-xs font-medium {{ isset($darkMode) && $darkMode ? 'text-slate-400' : 'text-slate-500' }}">{{ $shop->name ?? 'Restoran' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            @yield('header_actions')

            <div class="w-px h-6 hidden sm:block {{ isset($darkMode) && $darkMode ? 'bg-slate-700' : 'bg-slate-200' }}"></div>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex flex-col text-right">
                    <span class="text-sm font-bold {{ isset($darkMode) && $darkMode ? 'text-white' : 'text-slate-900' }}">{{ Auth::user()->name }}</span>
                    <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-wider">{{ $shopUser->role ?? 'Staff' }}</span>
                </div>
                <div class="w-10 h-10 rounded-full border overflow-hidden shadow-sm flex items-center justify-center font-bold {{ isset($darkMode) && $darkMode ? 'bg-slate-700 border-slate-600 text-indigo-400' : 'bg-indigo-50 border-indigo-100 text-indigo-700' }}">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="ml-1">
                    @csrf
                    <button type="submit" class="p-2 rounded-lg transition-colors {{ isset($darkMode) && $darkMode ? 'text-slate-400 hover:text-rose-400 hover:bg-rose-900/30' : 'text-slate-400 hover:text-rose-600 hover:bg-rose-50' }}" title="Logout">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col relative {{ isset($noPadding) && $noPadding ? '' : 'p-4 sm:p-6' }}">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
