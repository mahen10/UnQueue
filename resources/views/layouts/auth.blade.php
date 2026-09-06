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
            --color-brand: #4f46e5;
            --color-brand-light: #6366f1;
            --color-surface: #f8fafc;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-surface text-gray-900 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Left Side: Image/Branding (Hidden on mobile) -->
    <div class="hidden md:flex md:w-1/2 bg-indigo-100 relative overflow-hidden flex-col justify-between p-12">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1000&q=80" alt="Restaurant Background" class="w-full h-full object-cover opacity-80 mix-blend-overlay">
            <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/90 via-orange-900/40 to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                <div class="absolute top-1.5 left-1.5 w-3 h-3 bg-blue-500 rounded-full mix-blend-multiply opacity-80"></div>
                <div class="absolute top-1.5 right-1.5 w-3 h-3 bg-rose-500 rounded-full mix-blend-multiply opacity-80"></div>
                <div class="absolute bottom-1.5 left-1.5 w-3 h-3 bg-amber-500 rounded-full mix-blend-multiply opacity-80"></div>
                <div class="absolute bottom-1.5 right-1.5 w-3 h-3 bg-emerald-500 rounded-full mix-blend-multiply opacity-80"></div>
            </div>
            <span class="font-extrabold text-2xl tracking-tight text-white">UnQueue</span>
        </div>

        <div class="relative z-10 text-white max-w-md">
            <h2 class="text-4xl font-extrabold mb-4 leading-tight">Digitalisasi Restoran Anda Hari Ini</h2>
            <p class="text-indigo-100 text-lg font-medium">Bergabung dengan +2,000 restoran lainnya yang telah meningkatkan omzet dan efisiensi bersama UnQueue.</p>
        </div>
    </div>

    <!-- Right Side: Content -->
    <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 min-h-screen bg-white relative">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="md:hidden flex items-center justify-center gap-3 mb-10">
                <div class="w-10 h-10 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                    <div class="absolute top-1.5 left-1.5 w-3 h-3 bg-blue-500 rounded-full mix-blend-multiply opacity-80"></div>
                    <div class="absolute top-1.5 right-1.5 w-3 h-3 bg-rose-500 rounded-full mix-blend-multiply opacity-80"></div>
                    <div class="absolute bottom-1.5 left-1.5 w-3 h-3 bg-amber-500 rounded-full mix-blend-multiply opacity-80"></div>
                    <div class="absolute bottom-1.5 right-1.5 w-3 h-3 bg-emerald-500 rounded-full mix-blend-multiply opacity-80"></div>
                </div>
                <span class="font-extrabold text-2xl tracking-tight text-gray-900">UnQueue</span>
            </div>

            @yield('content')
            
        </div>
    </div>

</body>
</html>
