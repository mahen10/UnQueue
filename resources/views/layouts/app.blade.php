<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnQueue - @yield('title', 'Sistem Self-Service')</title>
    
    <!-- Tailwind CSS (CDN for development due to Node version issue) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 antialiased flex flex-col min-h-screen">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-6">
                    <a href="{{ route('landing') }}" class="text-xl font-bold text-orange-600 flex items-center gap-2 transition hover:scale-105">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        UnQueue
                    </a>
                    @if(Auth::check() && request()->attributes->get('shopUser') && request()->attributes->get('shopUser')->role === 'owner')
                        <div class="hidden sm:flex space-x-5 ml-8 text-sm font-semibold">
                            <a href="{{ route('owner.dashboard') }}" class="transition {{ request()->routeIs('owner.dashboard') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Dashboard</a>
                            <a href="{{ route('owner.reports.index') }}" class="transition {{ request()->routeIs('owner.reports.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Laporan</a>
                            <a href="{{ route('owner.categories.index') }}" class="transition {{ request()->routeIs('owner.categories.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Kategori</a>
                            <a href="{{ route('owner.menu-items.index') }}" class="transition {{ request()->routeIs('owner.menu-items.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Menu</a>
                            <a href="{{ route('owner.tables.index') }}" class="transition {{ request()->routeIs('owner.tables.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Meja</a>
                            <a href="{{ route('owner.staff.index') }}" class="transition {{ request()->routeIs('owner.staff.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Karyawan</a>
                            <a href="{{ route('owner.settings.edit') }}" class="transition {{ request()->routeIs('owner.settings.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Pengaturan</a>
                            <a href="{{ route('owner.billing.index') }}" class="transition {{ request()->routeIs('owner.billing.*') ? 'text-orange-600 border-b-2 border-orange-600 pb-1' : 'text-gray-500 hover:text-orange-500 hover:border-b-2 hover:border-orange-200 pb-1' }}">Billing</a>
                        </div>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex flex-col items-end mr-4">
                            <span class="text-sm text-gray-900 font-bold">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500 font-mono">ID: {{ Auth::user()->uq_id }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-600 hover:text-red-600 transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-blue-600">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-medium bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm flex items-center gap-2 border border-red-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} UnQueue. All rights reserved.
        </div>
    </footer>

</body>
</html>
