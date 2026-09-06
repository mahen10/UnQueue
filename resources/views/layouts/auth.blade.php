<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UnQueue')</title>
    <!-- Tailwind CDN v4 -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --color-brand: #ea580c;
            --color-brand-light: #f97316;
            --color-surface: #fff8f4;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-surface text-gray-900 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Left Side: Image/Branding (Hidden on mobile) -->
    <div class="hidden md:flex md:w-1/2 bg-orange-100 relative overflow-hidden flex-col justify-between p-12">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1000&q=80" alt="Restaurant Background" class="w-full h-full object-cover opacity-80 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-orange-900/90 via-orange-900/40 to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex items-center gap-2">
            <div class="bg-brand text-white w-10 h-10 flex items-center justify-center rounded-xl font-black text-xl shadow-lg">UQ</div>
            <span class="font-extrabold text-2xl text-white">UnQueue</span>
        </div>

        <div class="relative z-10 text-white max-w-md">
            <h2 class="text-4xl font-extrabold mb-4 leading-tight">Digitalisasi Restoran Anda Hari Ini</h2>
            <p class="text-orange-100 text-lg font-medium">Bergabung dengan +2,000 restoran lainnya yang telah meningkatkan omzet dan efisiensi bersama UnQueue.</p>
        </div>
    </div>

    <!-- Right Side: Content -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 min-h-screen bg-white relative">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="md:hidden flex items-center justify-center gap-2 mb-10">
                <div class="bg-brand text-white w-10 h-10 flex items-center justify-center rounded-xl font-black text-xl shadow-lg shadow-orange-500/30">UQ</div>
                <span class="font-extrabold text-2xl text-gray-900">UnQueue</span>
            </div>

            @yield('content')
            
        </div>
    </div>

</body>
</html>
