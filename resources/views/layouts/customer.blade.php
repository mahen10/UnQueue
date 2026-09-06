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
                </h1>
                <p class="text-[13px] text-gray-500 font-medium mt-0.5">{{ $tableName ?? 'Takeaway / Bebas' }}</p>
            </div>
            {{-- Bagian kanan header dikosongkan sesuai permintaan (logo guest dan poin dihapus) --}}
        </div>

        @yield('content')
        
    </main>

    @stack('scripts')
</body>
</html>
