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
                    <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        UnQueue
                    </a>
                    @if(Auth::check() && request()->attributes->get('shopUser') && request()->attributes->get('shopUser')->role === 'owner')
                        <div class="hidden sm:flex space-x-4 ml-6 text-sm font-medium">
                            <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Dashboard</a>
                            <a href="{{ route('owner.reports.index') }}" class="{{ request()->routeIs('owner.reports.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Laporan</a>
                            <a href="{{ route('owner.categories.index') }}" class="{{ request()->routeIs('owner.categories.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Menu</a>
                            <a href="{{ route('owner.tables.index') }}" class="{{ request()->routeIs('owner.tables.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Meja</a>
                            <a href="{{ route('owner.staff.index') }}" class="{{ request()->routeIs('owner.staff.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Karyawan</a>
                            <a href="{{ route('owner.settings.edit') }}" class="{{ request()->routeIs('owner.settings.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Pengaturan</a>
                            <a href="{{ route('owner.billing.index') }}" class="{{ request()->routeIs('owner.billing.*') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">Billing</a>
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
