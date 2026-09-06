<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Menu') - {{ $shopName ?? 'UnQueue' }}</title>
    
    <!-- Tailwind CDN v4 -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Inter', sans-serif;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FAFAFA; /* Very light gray background to match reference */
        }
        .pb-safe { padding-bottom: calc(env(safe-area-inset-bottom) + 7rem); }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="text-gray-900 antialiased relative min-h-screen">

    {{-- Content area --}}
    <main class="max-w-md mx-auto bg-white min-h-screen relative pb-safe shadow-sm">
        
        {{-- Custom Header matching reference --}}
        <div class="px-5 pt-6 pb-2 flex justify-between items-start bg-white z-40 sticky top-0">
            <div class="flex flex-col">
                <h1 class="text-lg font-extrabold text-gray-900 tracking-tight flex items-center gap-1 cursor-pointer">
                    {{ strtoupper($shopName ?? 'UNQUEUE STORE') }}
                    <svg class="w-4 h-4 text-gray-900 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                </h1>
                <p class="text-[13px] text-gray-500 font-medium mt-0.5">{{ $tableName ?? 'Takeaway' }}</p>
            </div>
            <div class="flex flex-col items-center cursor-pointer">
                <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200">
                    <img src="https://ui-avatars.com/api/?name=Guest&background=F3F4F6&color=111827&bold=true" alt="Profile" class="w-full h-full object-cover">
                </div>
                <div class="flex items-center gap-1 mt-1 bg-gray-100 rounded-full px-2 py-0.5">
                    <span class="text-[10px] font-bold text-gray-900">0</span>
                    <svg class="w-2.5 h-2.5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                </div>
            </div>
        </div>

        @yield('content')
        
        {{-- Floating Bottom Action Bar --}}
        <div class="fixed bottom-6 left-0 right-0 z-50 flex justify-center pointer-events-none px-4">
            <div class="relative pointer-events-auto flex items-center bg-gray-100/90 backdrop-blur-md p-1.5 rounded-full shadow-lg border border-white/50 ring-1 ring-black/5">
                
                {{-- Tooltip (Optional/Hardcoded per reference) --}}
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-gray-100 px-3 py-1.5 rounded-2xl flex items-center gap-1.5 shadow-sm border border-gray-200 whitespace-nowrap">
                    <svg class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span class="text-[11px] font-semibold text-gray-700">You'll earn points!</span>
                </div>

                {{-- Toggles --}}
                <div class="flex items-center gap-1 px-1">
                    <button class="bg-white text-gray-900 text-sm font-bold px-5 py-3 rounded-full shadow-sm transition active:scale-95">
                        Menu
                    </button>
                    <button class="text-gray-600 text-sm font-bold px-5 py-3 rounded-full hover:text-gray-900 transition active:scale-95">
                        QR code
                    </button>
                </div>

                {{-- Cart Button --}}
                <a href="{{ route('customer.cart') }}" class="ml-2 bg-[#111] text-white flex items-center gap-2 px-5 py-3 rounded-full shadow-md hover:bg-black transition active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span class="text-sm font-bold">
                        {{ isset($cartCount) && $cartCount > 0 ? $cartCount . ' items' : 'Empty' }}
                    </span>
                </a>
            </div>
        </div>

    </main>

    @stack('scripts')
</body>
</html>
