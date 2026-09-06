<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnQueue - Revolusi Restoran Masa Depan</title>
    <!-- Tailwind CDN v4 -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', sans-serif;
            --color-brand: #4f46e5; /* Orange 600 */
            --color-brand-light: #6366f1; /* Orange 500 */
            --color-surface: #f8fafc; /* Warm peach background */
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased overflow-x-hidden">

    {{-- Navbar --}}
    <nav class="fixed w-full z-50 transition-all duration-300 bg-surface/90 backdrop-blur-md border-b border-indigo-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3 cursor-pointer">
                    <div class="w-10 h-10 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                        <div class="absolute top-1.5 left-1.5 w-3 h-3 bg-blue-500 rounded-full mix-blend-multiply opacity-80"></div>
                        <div class="absolute top-1.5 right-1.5 w-3 h-3 bg-rose-500 rounded-full mix-blend-multiply opacity-80"></div>
                        <div class="absolute bottom-1.5 left-1.5 w-3 h-3 bg-amber-500 rounded-full mix-blend-multiply opacity-80"></div>
                        <div class="absolute bottom-1.5 right-1.5 w-3 h-3 bg-emerald-500 rounded-full mix-blend-multiply opacity-80"></div>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-gray-900">UnQueue</span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#" class="text-brand font-bold text-sm">Home</a>
                    <a href="#fitur" class="text-gray-600 hover:text-brand font-semibold text-sm transition">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-brand font-semibold text-sm transition">Cara Kerja</a>
                    <a href="#harga" class="text-gray-600 hover:text-brand font-semibold text-sm transition">Harga</a>
                </div>

                <!-- Right Action -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('login') }}" class="text-gray-700 font-bold hover:text-brand transition text-sm">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-brand hover:bg-indigo-700 text-white px-6 py-2.5 rounded-full font-bold shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 text-sm">
                        Daftar Gratis
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-surface">
        <!-- Decor blobs -->
        <div class="absolute top-20 right-10 w-4 h-4 bg-blue-400 rounded-full blur-[1px]"></div>
        <div class="absolute top-40 left-20 w-3 h-3 bg-brand rounded-full blur-[1px]"></div>
        <div class="absolute bottom-20 right-1/4 w-5 h-5 bg-indigo-300 rounded-full blur-[1px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                
                <!-- Left Content -->
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-100/80 text-brand font-bold text-xs mb-6 border border-indigo-200">
                        <span class="text-yellow-500">✦</span> Cepat • Praktis • Akurat
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 leading-[1.1] tracking-tight mb-6">
                        Revolusi <span class="text-brand">Pesanan</span>,<br>
                        Langsung Dari<br>
                        Meja Anda
                    </h1>
                    
                    <p class="text-lg text-gray-600 mb-8 max-w-lg leading-relaxed font-medium">
                        Tingkatkan omzet dan efisiensi restoran Anda. Pelanggan cukup scan QR, pesan, dan bayar. Pesanan langsung terhubung ke dapur dan kasir.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-4 mb-10">
                        <a href="{{ route('register') }}" class="bg-brand hover:bg-indigo-700 text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-indigo-500/30 transition hover:-translate-y-1 flex items-center gap-2 text-lg">
                            Mulai Sekarang
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <button class="px-8 py-4 rounded-full font-bold text-gray-700 hover:text-brand hover:bg-white transition flex items-center gap-3 text-lg">
                            <div class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-brand">
                                <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6V4z"></path></svg>
                            </div>
                            Lihat Demo
                        </button>
                    </div>
                    
                    <!-- Social Proof -->
                    <div class="flex items-center gap-4 pt-4">
                        <div class="flex -space-x-3">
                            <img class="w-10 h-10 rounded-full border-2 border-surface" src="https://i.pravatar.cc/100?img=1" alt="Avatar">
                            <img class="w-10 h-10 rounded-full border-2 border-surface" src="https://i.pravatar.cc/100?img=2" alt="Avatar">
                            <img class="w-10 h-10 rounded-full border-2 border-surface" src="https://i.pravatar.cc/100?img=3" alt="Avatar">
                            <div class="w-10 h-10 rounded-full border-2 border-surface bg-gray-900 text-white flex items-center justify-center text-xs font-bold">+2k</div>
                        </div>
                        <div>
                            <p class="text-sm font-extrabold text-gray-900">Restoran Bergabung</p>
                            <div class="flex items-center gap-1 text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="text-gray-900 font-bold ml-1">4.9</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Content (Images & Badges) -->
                <div class="relative lg:ml-auto">
                    <!-- Main Image Placeholder (Happy owner/customer) -->
                    <div class="relative z-10 w-[90%] md:w-[80%] lg:w-full mx-auto">
                        <div class="aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80" alt="Restaurant Owner" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Floating Badge 1: New Order -->
                    <div class="absolute top-12 -left-8 md:-left-12 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 z-20 animate-[bounce_3s_ease-in-out_infinite]">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-brand">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Meja 4</p>
                            <p class="text-sm font-bold text-gray-900">Pesanan Baru!</p>
                        </div>
                    </div>

                    <!-- Floating Badge 2: Revenue -->
                    <div class="absolute bottom-20 -right-4 md:-right-8 bg-white p-3 rounded-2xl shadow-xl flex items-center gap-3 z-20">
                        <div class="w-12 h-12 rounded-xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover">
                        </div>
                        <div class="pr-2">
                            <p class="text-xs font-bold text-brand mb-1">PROFIT NAIK 50%</p>
                            <p class="text-xs text-gray-500 font-medium">Bulan Pertama</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Features Section (Why Choose Us) --}}
    <div id="fitur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-brand font-bold tracking-widest text-sm uppercase mb-3">• MENGAPA MEMILIH KAMI •</p>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-16">
                Partner Terbaik Untuk<br>Bisnis Kuliner Anda
            </h2>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 mb-6 relative">
                        <div class="absolute inset-0 bg-indigo-100 rounded-full scale-110"></div>
                        <img src="https://cdn-icons-png.flaticon.com/512/879/879796.png" class="w-full h-full object-contain relative z-10" alt="Fast">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pesanan Instan</h3>
                    <p class="text-gray-500 font-medium leading-relaxed max-w-xs text-center">
                        Pelanggan memesan langsung dari meja. Tidak perlu lagi antri di kasir atau menunggu pelayan.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 mb-6 relative">
                        <div class="absolute inset-0 bg-indigo-100 rounded-full scale-110"></div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3588/3588294.png" class="w-full h-full object-contain relative z-10" alt="Variety">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Integrasi Dapur</h3>
                    <p class="text-gray-500 font-medium leading-relaxed max-w-xs text-center">
                        Pesanan otomatis masuk ke layar dapur (KDS). Mengurangi kesalahan catat dan mempercepat penyajian.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 mb-6 relative">
                        <div class="absolute inset-0 bg-indigo-100 rounded-full scale-110"></div>
                        <img src="https://cdn-icons-png.flaticon.com/512/2953/2953423.png" class="w-full h-full object-contain relative z-10" alt="Quality">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Transaksi Aman</h3>
                    <p class="text-gray-500 font-medium leading-relaxed max-w-xs text-center">
                        Mendukung pembayaran digital langsung dari smartphone pelanggan dengan sistem terenkripsi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Showcase Section (Fitur Keren) --}}
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-brand font-bold tracking-widest text-sm uppercase mb-3">• JELAJAHI SISTEM KAMI •</p>
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900">
                    Sistem Lengkap Dalam<br>Satu Aplikasi
                </h2>
                <div class="flex gap-4 mt-6 md:mt-0">
                    <button class="w-12 h-12 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:text-brand hover:border-brand transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-brand text-white flex items-center justify-center hover:bg-indigo-700 transition shadow-md shadow-indigo-500/30">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Nav -->
                <div class="lg:w-1/4 flex flex-row lg:flex-col gap-3 overflow-x-auto hide-scrollbar pb-4 lg:pb-0">
                    <button class="bg-brand text-white font-bold py-4 px-6 rounded-2xl flex items-center gap-4 min-w-max shadow-md shadow-indigo-500/20">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">📱</div>
                        Menu Digital
                    </button>
                    <button class="bg-white text-gray-700 font-bold py-4 px-6 rounded-2xl flex items-center gap-4 min-w-max border border-transparent hover:border-gray-200 transition">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">👨‍🍳</div>
                        Kitchen Display
                    </button>
                    <button class="bg-white text-gray-700 font-bold py-4 px-6 rounded-2xl flex items-center gap-4 min-w-max border border-transparent hover:border-gray-200 transition">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">💻</div>
                        Kasir POS
                    </button>
                    <button class="bg-white text-gray-700 font-bold py-4 px-6 rounded-2xl flex items-center gap-4 min-w-max border border-transparent hover:border-gray-200 transition">
                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">📊</div>
                        Analytics
                    </button>
                </div>

                <!-- Content Grid (Cards matching the reference) -->
                <div class="lg:w-3/4 grid md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-[#111] rounded-[2rem] overflow-hidden relative group cursor-pointer aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4 bg-brand text-white text-xs font-bold px-3 py-1.5 rounded-lg">Popular</div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-xl font-bold text-white mb-1">Tampilan Menu</h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-yellow-400 text-sm">★ 4.9</span>
                                <span class="text-gray-300 text-sm">(Elegan)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-white font-bold text-lg">Responsif</span>
                                <button class="bg-brand hover:bg-indigo-600 text-white text-sm font-bold px-4 py-2 rounded-lg transition">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-[#111] rounded-[2rem] overflow-hidden relative group cursor-pointer aspect-[3/4]">
                        <img src="https://images.unsplash.com/photo-1563245372-f21724e3856d?auto=format&fit=crop&w=600&q=80" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-xl font-bold text-white mb-1">Opsi Modifiers</h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-yellow-400 text-sm">★ 4.8</span>
                                <span class="text-gray-300 text-sm">(Custom)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-white font-bold text-lg">Detail</span>
                                <button class="bg-brand hover:bg-indigo-600 text-white text-sm font-bold px-4 py-2 rounded-lg transition">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-[#111] rounded-[2rem] overflow-hidden relative group cursor-pointer aspect-[3/4] hidden md:block">
                        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=600&q=80" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-xl font-bold text-white mb-1">Keranjang</h3>
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-yellow-400 text-sm">★ 5.0</span>
                                <span class="text-gray-300 text-sm">(Cepat)</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-white font-bold text-lg">Checkout</span>
                                <button class="bg-brand hover:bg-indigo-600 text-white text-sm font-bold px-4 py-2 rounded-lg transition">Lihat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA App Section --}}
    <div class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-indigo-50 rounded-[3rem] p-8 md:p-16 flex flex-col md:flex-row items-center justify-between gap-12 relative overflow-hidden">
                <!-- Decor -->
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
                
                <div class="max-w-xl relative z-10 text-center md:text-left">
                    <p class="text-brand font-bold tracking-widest text-sm uppercase mb-3">• MULAI DIGITALISASI •</p>
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                        Tingkatkan Profit Restoran Anda Hari Ini!
                    </h2>
                    <p class="text-gray-600 mb-8 text-lg font-medium">
                        Daftar sekarang dan nikmati sistem manajemen restoran berbasis QR yang akan memudahkan staf dan memanjakan pelanggan Anda.
                    </p>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-brand hover:bg-indigo-700 text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-indigo-500/30 transition hover:-translate-y-1 text-lg">
                        Buat Toko Gratis ➔
                    </a>
                </div>

                <!-- Mockup App Image -->
                <div class="relative z-10 w-full max-w-xs mx-auto md:mx-0">
                    <img src="https://images.unsplash.com/photo-1555421689-d68471e189f2?auto=format&fit=crop&w=400&q=80" alt="App Mockup" class="w-full rounded-3xl shadow-2xl rotate-2 hover:rotate-0 transition duration-500 border-4 border-white">
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-white pt-16 pb-8 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                            <div class="absolute top-1.5 left-1.5 w-3 h-3 bg-blue-500 rounded-full mix-blend-multiply opacity-80"></div>
                            <div class="absolute top-1.5 right-1.5 w-3 h-3 bg-rose-500 rounded-full mix-blend-multiply opacity-80"></div>
                            <div class="absolute bottom-1.5 left-1.5 w-3 h-3 bg-amber-500 rounded-full mix-blend-multiply opacity-80"></div>
                            <div class="absolute bottom-1.5 right-1.5 w-3 h-3 bg-emerald-500 rounded-full mix-blend-multiply opacity-80"></div>
                        </div>
                        <span class="font-extrabold text-xl tracking-tight text-gray-900">UnQueue</span>
                    </div>
                    <p class="text-gray-500 font-medium max-w-sm mb-6">Sistem pemesanan QR terbaik untuk restoran modern. Cepat, mudah, dan terintegrasi.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-brand"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="text-gray-400 hover:text-brand"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Perusahaan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-brand">Karir</a></li>
                        <li><a href="#" class="hover:text-brand">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-4">Dukungan</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-brand">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-brand">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-brand">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-100 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} UnQueue. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>
