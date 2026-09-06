<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Menu') — {{ $shopName ?? 'UnQueue' }}</title>
    
    <!-- Tailwind CDN v4 -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', sans-serif;
        }
        /* Safe area for mobile bottom bar */
        .pb-safe { padding-bottom: calc(env(safe-area-inset-bottom) + 5rem); }
        .bottom-bar { padding-bottom: calc(env(safe-area-inset-bottom)); }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 antialiased">

    {{-- Sticky Top Bar --}}
    <div class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
        <div class="max-w-lg mx-auto px-4 py-3 flex justify-between items-center">
            <div>
                <p class="font-bold text-gray-900 text-sm">{{ $shopName ?? '' }}</p>
                <p class="text-xs text-gray-500">{{ $tableName ?? '' }}</p>
            </div>
            {{-- Keranjang Icon dengan Badge --}}
            <a href="{{ route('customer.cart') }}" class="relative p-2">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-9H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @if(isset($cartCount) && $cartCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                    {{ $cartCount }}
                </span>
                @endif
            </a>
        </div>
    </div>

    {{-- Content area with top padding for fixed header --}}
    <main class="max-w-lg mx-auto mt-16 pb-safe">
        @yield('content')
    </main>

</body>
</html>
