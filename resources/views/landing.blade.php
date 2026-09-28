<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UnQueue - Revolusi Restoran Masa Depan</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <style>
        @layer base {
            html, body { margin:0; padding:0; }
            body { overscroll-behavior:none; }
            main > :first-child { margin-top:0!important; }
            main > :last-child { margin-bottom:0!important; }
        }
        ::-webkit-scrollbar { display:none; }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(49, 107, 243, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(49, 107, 243, 0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-float-slow { animation: floatSlow 4s ease-in-out infinite; }
        .animate-float-delayed { animation: floatSlow 4.5s ease-in-out infinite 1.5s; }
        .animate-radar-pulse { animation: pulseGlow 2s infinite cubic-bezier(0.4, 0, 0.6, 1); }
        .shimmer-text {
            background: linear-gradient(90deg, #003c90 0%, #316bf3 50%, #003c90 100%);
            background-size: 200% auto;
            color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }
        .animate-marquee-track {
            display: flex;
            width: max-content;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee-track:hover {
            animation-play-state: paused;
        }
    </style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{colors:{"on-primary-container":"#bcceff","surface":"#faf8ff","secondary":"#0051d5","inverse-surface":"#283044","on-tertiary":"#ffffff","primary-container":"#0f52ba","on-surface-variant":"#434653","surface-bright":"#faf8ff","error":"#ba1a1a","surface-variant":"#dae2fd","surface-container-high":"#e2e7ff","primary":"#003c90","outline-variant":"#c3c6d5","surface-tint":"#1d59c1","outline":"#737784","on-error":"#ffffff","inverse-primary":"#b0c6ff","on-background":"#131b2e","tertiary":"#32434c","surface-dim":"#d2d9f4","on-secondary-fixed-variant":"#003ea8","secondary-fixed-dim":"#b4c5ff","inverse-on-surface":"#eef0ff","tertiary-fixed-dim":"#b7c9d5","on-secondary":"#ffffff","on-secondary-fixed":"#00174b","error-container":"#ffdad6","on-primary":"#ffffff","on-error-container":"#93000a","surface-container-low":"#f2f3ff","surface-container-lowest":"#ffffff","secondary-container":"#316bf3","on-tertiary-fixed-variant":"#384953","on-secondary-container":"#fefcff","tertiary-fixed":"#d3e5f1","tertiary-container":"#495a64","primary-fixed-dim":"#b0c6ff","on-surface":"#131b2e","surface-container-highest":"#dae2fd","on-primary-fixed-variant":"#00419c","secondary-fixed":"#dbe1ff","on-tertiary-container":"#bfd1dc","background":"#faf8ff","primary-fixed":"#d9e2ff","on-primary-fixed":"#001945","on-tertiary-fixed":"#0c1e26","surface-container":"#eaedff"},borderRadius:{"DEFAULT":"0.25rem","lg":"0.5rem","xl":"0.75rem","full":"9999px"},spacing:{"gutter":"1.5rem","space-xl":"2rem","margin":"2rem","gutter-mobile":"1rem","space-sm":"0.5rem","space-md":"1rem","margin-mobile":"1rem","space-lg":"1.5rem","space-xs":"0.25rem"},fontFamily:{"headline-md":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"headline-lg-mobile":["Plus Jakarta Sans"],"label-md":["Plus Jakarta Sans"],"label-sm":["Plus Jakarta Sans"],"body-lg":["Plus Jakarta Sans"],"body-md":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"],"display-lg-mobile":["Plus Jakarta Sans"],"body-sm":["Plus Jakarta Sans"],"label-lg":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"display-lg":["Plus Jakarta Sans"]},fontSize:{"headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],"headline-sm":["20px",{"lineHeight":"28px","fontWeight":"600"}],"headline-lg-mobile":["24px",{"lineHeight":"32px","fontWeight":"600"}],"label-md":["12px",{"lineHeight":"16px","fontWeight":"600"}],"label-sm":["10px",{"lineHeight":"14px","fontWeight":"700"}],"body-lg":["16px",{"lineHeight":"26px","fontWeight":"400"}],"body-md":["14px",{"lineHeight":"22px","fontWeight":"400"}],"title-md":["16px",{"lineHeight":"24px","fontWeight":"600"}],"display-lg-mobile":["32px",{"lineHeight":"40px","fontWeight":"700"}],"body-sm":["12px",{"lineHeight":"18px","fontWeight":"400"}],"label-lg":["14px",{"lineHeight":"20px","fontWeight":"600"}],"headline-lg":["32px",{"lineHeight":"40px","fontWeight":"600"}],"display-lg":["48px",{"lineHeight":"56px","fontWeight":"700"}]}}}};
    </script>
</head>
<body class="bg-surface font-body-md text-on-surface antialiased selection:bg-primary-container selection:text-on-primary-container">
<header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest/85 backdrop-blur-xl border-b border-surface-container-high/60 shadow-[0_1px_12px_rgba(0,0,0,0.04)]">
    <div class="h-20 max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between gap-6">
        <div class="flex items-center gap-3 shrink-0">
            <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold hidden sm:inline-block text-2xl">⚡ UNQUEUE</span>
        </div>
        <nav class="hidden lg:flex items-center gap-1 xl:gap-2 px-3 py-1.5 rounded-full bg-surface-container-low/70">
            <a class="px-4 py-2 rounded-full transition-colors bg-primary-container text-on-primary font-title-md" href="#">Fitur Utama</a>
            <a class="px-4 py-2 rounded-full font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" href="#live-simulator">Simulasi Cepat</a>
            <a class="px-4 py-2 rounded-full font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" href="#kategori-fnb">Kategori F&amp;B</a>
            <a class="px-4 py-2 rounded-full font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors" href="#keamanan">Keamanan</a>
        </nav>
        <div class="flex items-center gap-3 shrink-0">
            @auth
                <a class="hidden md:inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-label-lg text-label-lg text-primary hover:bg-surface-container-high hover:text-on-surface transition-colors font-bold" href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="hidden md:inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-label-lg text-label-lg text-primary hover:bg-surface-container-high hover:text-on-surface transition-colors font-bold" href="{{ route('login') }}">Masuk</a>
                <a class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-label-lg text-label-lg bg-primary-container text-on-primary hover:bg-primary transition-all duration-200 shadow-sm active:scale-95 font-bold" href="{{ route('register') }}">Daftar Sekarang</a>
            @endauth
        </div>
    </div>
</header>
<main class="w-full pt-20 bg-surface min-h-[calc(100vh-20rem)]">
    <div class="flex flex-col w-full">
        <!-- SECTION 1: HERO -->
        <section class="relative w-full overflow-hidden bg-surface pt-8 pb-16 lg:pt-14 lg:pb-24 border-b border-surface-container-high/40">
            <div class="absolute -top-32 left-10 w-[520px] h-[360px] bg-secondary-fixed/40 blur-[130px] rounded-full pointer-events-none -z-10"></div>
            <div class="absolute top-1/4 -right-16 w-[480px] h-[480px] bg-primary-fixed/35 blur-[150px] rounded-full pointer-events-none -z-10"></div>
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                    <div class="lg:col-span-6 space-y-6 text-left">
                        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-surface-container-low border border-primary-fixed-dim/50 shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-secondary-container animate-radar-pulse"></span>
                            <span class="font-label-md text-label-md text-primary font-bold tracking-wide">⚡ Platform Billing &amp; Manajemen Restoran Berbasis QR</span>
                        </div>
                        <h1 class="font-display-lg text-display-lg-mobile lg:text-display-lg tracking-tight text-on-surface font-extrabold leading-[1.12]">Tingkatkan Profit Restoran Anda <span class="shimmer-text block mt-1">Hari Ini!</span></h1>
                        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl leading-relaxed">Daftar sekarang dan nikmati sistem manajemen restoran berbasis QR yang akan memudahkan staf dan memanjakan pelanggan Anda.</p>
                        
                        <div class="p-4 rounded-2xl bg-surface-container-low border border-surface-container-high flex items-center justify-between gap-4 max-w-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[22px]">payments</span>
                                </div>
                                <div>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase font-semibold">Biaya Langganan Tetap</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="font-headline-sm text-headline-sm text-primary font-bold">Rp 150.000</span>
                                        <span class="font-body-sm text-body-sm text-on-surface-variant">/ bulan / outlet</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-surface-container-lowest text-primary font-label-sm text-label-sm font-bold shadow-sm whitespace-nowrap">Tanpa Biaya Instalasi</span>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-1">
                            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-xl font-label-lg text-label-lg bg-primary-container text-on-primary shadow-lg hover:bg-primary hover:shadow-primary/30 transition-all duration-200 active:scale-95 group font-bold" href="{{ route('register') }}">
                                <span>Daftar Sekarang</span><span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                            <button class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl font-label-lg text-label-lg bg-surface-container-lowest text-primary border border-outline-variant/40 shadow-sm hover:bg-surface-container-high transition-all duration-200 active:scale-95 font-semibold" onclick="document.getElementById('demo-modal').classList.remove('hidden')" type="button">
                                <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">play_circle</span>
                                <span>Jadwalkan Live Demo</span>
                            </button>
                        </div>
                        
                        <div class="flex items-center gap-4 pt-2 text-on-surface-variant font-body-sm text-body-sm">
                            <div class="flex items-center gap-1 text-[#F59E0B]">
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="font-title-md text-title-md text-on-surface font-bold ml-1">4.9</span>
                            </div>
                            <span class="w-1.5 h-1.5 rounded-full bg-outline-variant"></span>
                            <span>Dipercaya <strong>1.200+ Kedai Kopi, Kafe, &amp; Restoran</strong> di Indonesia</span>
                        </div>
                    </div>
                    
                    <div class="lg:col-span-6 relative" id="live-simulator">
                        <div class="relative grid grid-cols-12 gap-3 sm:gap-4 rounded-3xl p-3 bg-surface-container-low/70 border border-surface-container-high shadow-2xl">
                            <div class="col-span-7 relative rounded-2xl overflow-hidden shadow-md group">
                                <img alt="Coffee Shop" class="w-full h-72 sm:h-80 object-cover object-center group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsZjVIGro393n0IdsweZJEYTizPTxDu1PYD1SVLAJPdIvXT4RFiQL4DGabwhqbpqjjbIELfP_BoM-bDdVKQ3ifQPnDFFSWb79tiqooG1VFJjmDM2If3yItk1xtj03KpR9tJx7xRXMvtwypDQdCc0BLDrdgHqgTdZuyOYCKCMwa8Q3xr9tQXPyGFRko3MuiZNMzJWi_q-hdZWhkXjqCQ3Y3wO7JI-QTcoM-Bn0EDEaEx8A-2geGhXAF">
                                <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/80 via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 rounded-full bg-surface-container-lowest/90 backdrop-blur-md font-label-sm text-label-sm text-primary font-bold flex items-center gap-1.5 shadow-sm">
                                        <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                                        Coffee Shop &amp; Bakery
                                    </span>
                                </div>
                                <div class="absolute bottom-3 left-3 right-3 text-on-tertiary">
                                    <p class="font-title-md text-title-md text-white font-bold leading-tight">Artisanal Coffee &amp; Pastry</p>
                                    <p class="font-body-sm text-[11px] text-surface-variant truncate">QR Scan Meja Kasir Cepat &lt; 3 Detik</p>
                                </div>
                            </div>
                            
                            <div class="col-span-5 relative rounded-2xl overflow-hidden shadow-md group">
                                <img alt="Fine Dining" class="w-full h-72 sm:h-80 object-cover object-center group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida/AEtjO1WImC_tGcCaOEUwdYjEvZYi_j_x5o8Nt_3Yhs7i34gQxpTjVwDBlcRVT2P_OdjgUhWRyjUfBh5zzOewdMmEYzkvxIHezT0Sv_mljyu0OC6hck2oXxHRyQFHPe5k4R4vfqFCSUFvT9h1wmZfpUJe7ilm1WgvpzsiGXu6ctlGyW5R2cM3O-FpJMEWJLS7kSQAZCIeb5IxyIsjeeR4JUDH76G_5ZgmGVF6VAIRHcbptOibx4XphTb9h8x2wuU">
                                <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/85 via-transparent to-transparent"></div>
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-0.5 rounded-full bg-inverse-surface/80 backdrop-blur-md font-label-sm text-[10px] text-on-primary font-semibold">
                                        Casual &amp; Bistro
                                    </span>
                                </div>
                                <div class="absolute bottom-3 left-3 right-3 text-white">
                                    <p class="font-title-md text-title-md font-bold leading-tight">Fine Dining</p>
                                    <p class="font-body-sm text-[11px] text-surface-variant truncate">Sync KDS Dapur Utama</p>
                                </div>
                            </div>
                            
                            <div class="absolute -top-5 left-6 bg-surface-container-lowest/95 backdrop-blur-xl px-4 py-2.5 rounded-2xl shadow-xl border border-surface-container-high flex items-center gap-3 animate-float-slow">
                                <div class="w-8 h-8 rounded-xl bg-primary text-on-primary flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">coffee</span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-label-sm text-label-sm font-bold text-primary">Meja #04 Kafe</span>
                                        <span class="text-outline text-[10px]">• 0.4 detik lalu</span>
                                    </div>
                                    <p class="font-label-md text-label-md text-on-surface font-semibold">1x Pour-Over + 2x Almond Croissant</p>
                                </div>
                            </div>
                            
                            <div class="absolute -bottom-6 -right-2 sm:right-4 bg-surface-container-lowest/95 backdrop-blur-xl px-5 py-3 rounded-2xl shadow-2xl border border-surface-container-high flex items-center gap-3 animate-float-delayed">
                                <div class="w-3.5 h-3.5 rounded-full bg-[#10B981] animate-ping"></div>
                                <div>
                                    <p class="font-label-sm text-label-sm text-on-surface-variant font-semibold">⏱️ KDS Barista Sync</p>
                                    <p class="font-title-md text-title-md text-primary font-bold">0.8 Detik Terkirim!</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 bg-surface-container-lowest rounded-2xl p-4 shadow-md border border-surface-container-high">
                            <div class="flex items-center justify-between mb-3 border-b border-surface-container-high pb-2">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-secondary-container animate-radar-pulse"></span>
                                    <span class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-primary">Live Transaction Pipeline UNQUEUE</span>
                                </div>
                                <span class="font-label-sm text-[11px] font-semibold text-[#047857] bg-[#ECFDF5] px-2 py-0.5 rounded-full">QRIS Instant Verified</span>
                            </div>
                            <div class="grid grid-cols-3 gap-2 text-center">
                                <div class="p-2.5 rounded-xl bg-surface-container-low/70 border border-primary-fixed-dim/40">
                                    <span class="material-symbols-outlined text-primary text-[20px] mb-1">qr_code_scanner</span>
                                    <p class="font-label-sm text-[11px] font-bold text-on-surface">1. Tamu Scan Meja</p>
                                    <p class="font-body-sm text-[10px] text-on-surface-variant">&lt; 3 Detik Buka Menu</p>
                                </div>
                                <div class="p-2.5 rounded-xl bg-primary-container text-on-primary shadow-sm">
                                    <span class="material-symbols-outlined text-on-primary text-[20px] mb-1">soup_kitchen</span>
                                    <p class="font-label-sm text-[11px] font-bold text-white">2. KDS Barista &amp; Chef</p>
                                    <p class="font-body-sm text-[10px] text-on-primary-container">Auto-Print &amp; Alert</p>
                                </div>
                                <div class="p-2.5 rounded-xl bg-surface-container-low/70 border border-primary-fixed-dim/40">
                                    <span class="material-symbols-outlined text-[#047857] text-[20px] mb-1">check_circle</span>
                                    <p class="font-label-sm text-[11px] font-bold text-on-surface">3. Lunas QRIS</p>
                                    <p class="font-body-sm text-[10px] text-on-surface-variant">Struk Digital WA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 1.5: CONTINUOUS LIVE TICKER -->
        <div class="w-full bg-surface-container-low py-3.5 overflow-hidden border-b border-surface-container-high">
            <div class="animate-marquee-track flex items-center gap-6">
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Billing Real-Time:</span> Meja 04: Pembayaran QRIS Rp 125.000 Terverifikasi</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Kitchen Display:</span> Meja 12: Tiket Dapur Dikirim ke Chef (0.6s)</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Billing Selesai:</span> Meja 08: Tagihan Selesai &amp; Meja Siap Putar</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Service Alert:</span> Meja 15: Notifikasi Panggil Kasir Diterima</div>
                <!-- Duplicate for seamless scroll -->
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Billing Real-Time:</span> Meja 04: Pembayaran QRIS Rp 125.000 Terverifikasi</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Kitchen Display:</span> Meja 12: Tiket Dapur Dikirim ke Chef (0.6s)</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Billing Selesai:</span> Meja 08: Tagihan Selesai &amp; Meja Siap Putar</div>
                <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest shadow-sm font-label-sm text-label-sm text-on-surface shrink-0"><span class="w-2 h-2 rounded-full bg-secondary"></span><span class="font-bold text-primary">Service Alert:</span> Meja 15: Notifikasi Panggil Kasir Diterima</div>
            </div>
        </div>

        <!-- SECTION 2: SHOWCASE KULINER -->
        <section class="w-full bg-surface py-20" id="kuliner-showcase">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div class="max-w-2xl">
                        <span class="font-label-lg text-label-lg text-primary font-bold uppercase tracking-wider">Modul Lengkap Software Restoran</span>
                        <h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface font-bold mt-2">Satu Platform Billing &amp; Operasional untuk Segala Kebutuhan Meja</h2>
                        <p class="font-body-lg text-body-lg text-on-surface-variant mt-2">Kelola pesanan meja, pantau billing secara real-time, dan kurangi beban kasir tanpa perlu perangkat mahal.</p>
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-surface-container-low font-label-md text-label-md text-primary font-bold border border-surface-container-high shrink-0">
                        <span class="material-symbols-outlined text-[20px]">point_of_sale</span>
                        <span class="">Fitur Manajemen B2B</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Feature Cards -->
                    <div class="bg-surface-container-lowest rounded-2xl p-5 border border-surface-container-high/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors"><span class="material-symbols-outlined text-[22px]">receipt_long</span></span>
                            <span class="px-2.5 py-0.5 rounded-full bg-[#ECFDF5] text-[#047857] font-label-sm text-[11px] font-bold">Billing Cepat</span>
                        </div>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-surface font-bold">Smart Digital Billing</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1.5">Cetak &amp; kirim tagihan digital otomatis via WhatsApp/QRIS instan, rekap omzet meja akurat secara real-time tanpa selisih kasir.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-surface-container flex items-center justify-between">
                            <span class="font-label-sm text-[11px] font-bold text-primary flex items-center gap-1"><span class="material-symbols-outlined text-[15px]">verified</span> Bebas Selisih Kasir</span>
                            <span class="font-label-sm text-[11px] text-on-surface-variant">&lt; 3 Detik Terverifikasi</span>
                        </div>
                    </div>
                    
                    <div class="bg-surface-container-lowest rounded-2xl p-5 border border-surface-container-high/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors"><span class="material-symbols-outlined text-[22px]">soup_kitchen</span></span>
                            <span class="px-2.5 py-0.5 rounded-full bg-surface-container-high text-primary font-label-sm text-[11px] font-bold">Operasional Dapur</span>
                        </div>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-surface font-bold">Order Dispatcher ke KDS</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1.5">Pesanan meja langsung diteruskan otomatis ke layar dapur/barista dalam hitungan detik. Tanpa kertas bon hilang.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-surface-container flex items-center justify-between">
                            <span class="font-label-sm text-[11px] font-bold text-primary flex items-center gap-1"><span class="material-symbols-outlined text-[15px]">speed</span> Sync &lt; 1 Detik</span>
                            <span class="font-label-sm text-[11px] text-on-surface-variant">Multi-Station Kitchen</span>
                        </div>
                    </div>
                    
                    <div class="bg-surface-container-lowest rounded-2xl p-5 border border-surface-container-high/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors"><span class="material-symbols-outlined text-[22px]">qr_code_2</span></span>
                            <span class="px-2.5 py-0.5 rounded-full bg-secondary-fixed text-primary font-label-sm text-[11px] font-bold">Self-Service Meja</span>
                        </div>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-surface font-bold">QR Meja Dinamis</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1.5">Pelanggan cukup scan QR di meja untuk akses menu interaktif &amp; checkout mandiri tanpa repot install aplikasi.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-surface-container flex items-center justify-between">
                            <span class="font-label-sm text-[11px] font-bold text-primary flex items-center gap-1"><span class="material-symbols-outlined text-[15px]">devices</span> Zero-App Install</span>
                            <span class="font-label-sm text-[11px] text-on-surface-variant">Semua Smartphone</span>
                        </div>
                    </div>
                    
                    <div class="bg-surface-container-lowest rounded-2xl p-5 border border-surface-container-high/80 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-10 h-10 rounded-xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors"><span class="material-symbols-outlined text-[22px]">monitoring</span></span>
                            <span class="px-2.5 py-0.5 rounded-full bg-[#ECFDF5] text-[#047857] font-label-sm text-[11px] font-bold">Laporan Bisnis</span>
                        </div>
                        <div>
                            <h3 class="font-title-md text-title-md text-on-surface font-bold">Laporan Omzet &amp; Analitik</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1.5">Pantau menu terlaris, jam sibuk, kecepatan saji, dan total pendapatan harian langsung dari dashboard pemilik resto.</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-surface-container flex items-center justify-between">
                            <span class="font-label-sm text-[11px] font-bold text-primary flex items-center gap-1"><span class="material-symbols-outlined text-[15px]">insights</span> Real-Time Report</span>
                            <span class="font-label-sm text-[11px] text-on-surface-variant">Export Excel &amp; PDF</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2.5: F&B ADAPTATION -->
        <section class="w-full bg-surface-container-low/60 py-20" id="kategori-fnb">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
                    <span class="font-label-lg text-label-lg text-primary font-bold uppercase tracking-wider">Solusi Lengkap F&amp;B</span>
                    <h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface font-bold">Fleksibel untuk Beragam Format Bisnis Kuliner</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Satu ekosistem software cerdas yang menyesuaikan ritme operasional kedai kopi cepat saji hingga restoran santai berskala besar.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Cards -->
                    <div class="bg-surface-container-lowest rounded-3xl p-8 border border-surface-container-high shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-primary-fixed/60 text-primary flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-[30px]">local_cafe</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Coffee Shop &amp; Bakery</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6">Dirancang untuk volume transaksi cepat. Tamu memilih custom level gula, oat milk, dan langsung melunasi di meja agar barista segera meracik.</p>
                        <ul class="space-y-3 font-body-sm text-body-sm text-on-surface">
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Tiket otomatis split ke Barista &amp; Pastry</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Custom addon (syrup, double shot, extra ice)</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>QR Meja dan QR Akrilik Bar Counter</span></li>
                        </ul>
                    </div>
                    
                    <div class="bg-surface-container-lowest rounded-3xl p-8 border border-secondary-container/30 shadow-md hover:shadow-xl transition-all duration-300 relative">
                        <div class="absolute -top-3 right-6 bg-primary-container text-on-primary text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">Paling Populer</div>
                        <div class="w-14 h-14 rounded-2xl bg-secondary-fixed text-primary flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-[30px]">restaurant</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Casual Dining &amp; Resto</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6">Solusi terpadu multi-meja untuk makan bersama. Pelanggan memesan secara bertahap (pembuka, utama, penutup) tanpa bolak-balik panggil pelayan.</p>
                        <ul class="space-y-3 font-body-sm text-body-sm text-on-surface">
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Pemesanan tambahan (repeat order) tanpa ganti sesi</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>KDS Sinkronisasi Dapur Masak Panas &amp; Dingin</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Tombol digital panggil air minum &amp; pelayan</span></li>
                        </ul>
                    </div>
                    
                    <div class="bg-surface-container-lowest rounded-3xl p-8 border border-surface-container-high shadow-sm hover:shadow-xl transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-tertiary-fixed text-tertiary flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-[30px]">nightlife</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Bar, Lounge &amp; Bistro</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-2 mb-6">Atmosfer pencahayaan temaram tetap praktis. Tamu membuka menu digital dari smartphone dengan tampilan kontras tinggi dan konfirmasi pesanan cepat.</p>
                        <ul class="space-y-3 font-body-sm text-body-sm text-on-surface">
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Live status botol &amp; mocktail ready</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Notifikasi instan meja VIP ke bar head</span></li>
                            <li class="flex items-center gap-2.5"><span class="material-symbols-outlined text-primary text-[18px]">done</span><span>Pelunasan mandiri contactless tanpa serah terima kartu</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: THREE CORE FEATURES -->
        <section class="w-full bg-surface py-24" id="keamanan">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <span class="font-label-lg text-label-lg text-primary font-bold uppercase tracking-wider">Pondasi Efisiensi UNQUEUE</span>
                    <h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface font-bold">Tiga Pilar Otomasi Restoran Masa Kini</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Menghubungkan tamu, staf layanan, dan juru masak secara serentak tanpa gesekan komunikasi dan tanpa antrean panjang.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cards -->
                    <div class="flex flex-col bg-surface-container-lowest rounded-3xl p-8 border border-surface-container-high/60 shadow-sm hover:shadow-xl hover:border-primary-fixed-dim transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors duration-300 mb-6 shadow-sm">
                            <span class="material-symbols-outlined text-[30px]">qr_code_scanner</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Pesanan Instan</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 mb-6">Pelanggan memesan langsung dari meja. Tidak perlu lagi antri di kasir atau menunggu pelayan menghampiri.</p>
                        <div class="space-y-3.5 mb-8">
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>QR Code Dinamis:</strong> Akurasi pemetaan nomor meja otomatis tanpa instalasi aplikasi.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Menu Visual Interaktif:</strong> Foto resolusi tinggi, penyesuaian level pedas &amp; alergen.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Panggil Pelayan Digital:</strong> Notifikasi satu sentuhan untuk air minum atau bantuan staf.</span></div>
                        </div>
                        <div class="mt-auto pt-6 bg-surface-container-low/60 rounded-2xl p-4">
                            <div class="flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant mb-2 font-semibold">
                                <span>SCAN CODE SIMULATION</span><span class="text-secondary font-bold">ACTIVE</span>
                            </div>
                            <div class="bg-surface-container-lowest p-3 rounded-xl flex items-center gap-3 shadow-sm">
                                <div class="w-8 h-8 rounded-lg bg-surface-container flex items-center justify-center text-primary font-bold font-label-md text-label-md">#08</div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-title-md text-title-md text-on-surface font-semibold truncate">Meja VIP Terrace</p>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">Sesi Aktif: 3 Tamu</p>
                                </div>
                                <span class="material-symbols-outlined text-primary text-[20px]">sensors</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col bg-surface-container-lowest rounded-3xl p-8 border border-surface-container-high/60 shadow-sm hover:shadow-xl hover:border-primary-fixed-dim transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors duration-300 mb-6 shadow-sm">
                            <span class="material-symbols-outlined text-[30px]">soup_kitchen</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Integrasi Dapur (KDS)</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 mb-6">Pesanan otomatis masuk ke layar dapur (Kitchen Display System). Mengurangi kesalahan catat dan mempercepat penyajian.</p>
                        <div class="space-y-3.5 mb-8">
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Multi-Station Routing:</strong> Pemisahan tiket otomatis antara Kitchen, Bar, dan Pastry.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Timer Estimasi Otomatis:</strong> Indikator warna keterlambatan pengerjaan hidangan.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Sinkronisasi 3 Status:</strong> Memasak → Siap Saji → Disajikan terpantau langsung.</span></div>
                        </div>
                        <div class="mt-auto pt-6 bg-surface-container-low/60 rounded-2xl p-4">
                            <div class="flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant mb-2 font-semibold">
                                <span>LIVE KDS PIPELINE</span><span class="text-primary font-bold">3 TIKET AKTIF</span>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-surface-container-lowest text-on-surface font-body-sm text-body-sm shadow-sm">
                                    <span class="font-semibold text-primary">T-14 Salmon Truffle</span>
                                    <span class="px-2 py-0.5 rounded-full bg-surface-container-high text-primary font-label-sm text-label-sm font-semibold">Memasak 04:12</span>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 rounded-xl bg-surface-container-lowest text-on-surface font-body-sm text-body-sm shadow-sm">
                                    <span class="font-semibold text-on-surface">T-09 Iced Matcha</span>
                                    <span class="px-2 py-0.5 rounded-full bg-[#ECFDF5] text-[#047857] font-label-sm text-label-sm font-semibold">Siap Saji</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col bg-surface-container-lowest rounded-3xl p-8 border border-surface-container-high/60 shadow-sm hover:shadow-xl hover:border-primary-fixed-dim transition-all duration-300 group">
                        <div class="w-14 h-14 rounded-2xl bg-surface-container flex items-center justify-center text-primary group-hover:bg-primary-container group-hover:text-on-primary transition-colors duration-300 mb-6 shadow-sm">
                            <span class="material-symbols-outlined text-[30px]">security</span>
                        </div>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Transaksi Aman</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 mb-6">Mendukung pembayaran digital langsung dari smartphone pelanggan dengan sistem terenkripsi perbankan.</p>
                        <div class="space-y-3.5 mb-8">
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Omni-Channel Payment:</strong> QRIS Dinamis, E-Wallet (GoPay, OVO, ShopeePay), &amp; Kartu Kredit.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Enkripsi SSL 256-Bit:</strong> Proteksi data transaksi pelanggan dan sertifikasi PCI-DSS Level 1.</span></div>
                            <div class="flex items-start gap-3"><span class="material-symbols-outlined text-primary text-[18px] shrink-0 mt-0.5">check_circle</span><span class="font-body-sm text-body-sm text-on-surface"><strong>Konfirmasi Otomatis:</strong> Notifikasi status transaksi sukses seketika ke kasir dan dapur.</span></div>
                        </div>
                        <div class="mt-auto pt-6 bg-surface-container-low/60 rounded-2xl p-4">
                            <div class="flex items-center justify-between font-label-sm text-label-sm text-on-surface-variant mb-2 font-semibold">
                                <span>GERBANG PEMBAYARAN</span><span class="text-[#047857] font-bold">VERIFIKASI OTOMATIS</span>
                            </div>
                            <div class="bg-surface-container-lowest p-3 rounded-xl flex items-center justify-between shadow-sm">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary text-[20px]">lock</span>
                                    <span class="font-title-md text-title-md text-on-surface font-semibold">Settlement Instan</span>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg bg-surface-container font-label-sm text-label-sm font-bold text-primary">0% Chargeback</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: WORKFLOW -->
        <section class="w-full bg-surface-container-low/40 py-24">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center max-w-3xl mx-auto mb-20 space-y-4">
                    <span class="font-label-lg text-label-lg text-primary font-bold uppercase tracking-wider">Alur Kerja Tanpa Gesekan</span>
                    <h2 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-surface font-bold">3 Langkah Menghidupkan Meja Anda</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Dari kedatangan tamu hingga pelunasan tagihan, proses berjalan harmonis tanpa interupsi.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 relative">
                    <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-surface-container-high -z-0"></div>
                    <div class="relative flex flex-col items-center text-center group">
                        <div class="w-24 h-24 rounded-3xl bg-surface-container-lowest shadow-md flex items-center justify-center text-primary group-hover:scale-105 group-hover:bg-primary-container group-hover:text-on-primary transition-all duration-300 relative z-10 mb-8 border border-surface-container-high">
                            <span class="material-symbols-outlined text-[38px]">qr_code_2</span>
                            <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center text-[12px] font-bold">1</span>
                        </div>
                        <h3 class="font-title-md text-title-md lg:font-headline-sm lg:text-headline-sm text-on-surface font-bold">Scan QR di Meja</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 max-w-xs">Pelanggan memindai kode QR unik di meja mereka menggunakan kamera ponsel biasa. Menu langsung terbuka tanpa perlu mengunduh aplikasi apapun.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center group">
                        <div class="w-24 h-24 rounded-3xl bg-surface-container-lowest shadow-md flex items-center justify-center text-primary group-hover:scale-105 group-hover:bg-primary-container group-hover:text-on-primary transition-all duration-300 relative z-10 mb-8 border border-surface-container-high">
                            <span class="material-symbols-outlined text-[38px]">monitor_heart</span>
                            <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center text-[12px] font-bold">2</span>
                        </div>
                        <h3 class="font-title-md text-title-md lg:font-headline-sm lg:text-headline-sm text-on-surface font-bold">Dapur Menerima Pesanan</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 max-w-xs">Sistem KDS langsung mengorganisir pesanan sesuai prioritas waktu dan stasiun masak. Staf dapur &amp; barista fokus meracik tanpa kebingungan struk kertas.</p>
                    </div>
                    <div class="relative flex flex-col items-center text-center group">
                        <div class="w-24 h-24 rounded-3xl bg-surface-container-lowest shadow-md flex items-center justify-center text-primary group-hover:scale-105 group-hover:bg-primary-container group-hover:text-on-primary transition-all duration-300 relative z-10 mb-8 border border-surface-container-high">
                            <span class="material-symbols-outlined text-[38px]">credit_score</span>
                            <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center text-[12px] font-bold">3</span>
                        </div>
                        <h3 class="font-title-md text-title-md lg:font-headline-sm lg:text-headline-sm text-on-surface font-bold">Bayar &amp; Selesai</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-3 max-w-xs">Pelanggan membayar secara mandiri melalui metode digital favorit. Tagihan terverifikasi seketika dan meja siap untuk putaran tamu berikutnya.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5: STATS -->
        <section class="w-full bg-surface py-20 border-y border-surface-container-high/60">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                    <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                        <span class="font-display-lg text-display-lg-mobile lg:text-display-lg text-primary font-bold tracking-tight">+38%</span>
                        <p class="font-title-md text-title-md text-on-surface font-semibold mt-2">Kecepatan Rotasi Meja</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Table turnover bertambah 2 hingga 3 siklus per malam sibuk.</p>
                    </div>
                    <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                        <span class="font-display-lg text-display-lg-mobile lg:text-display-lg text-primary font-bold tracking-tight">0%</span>
                        <p class="font-title-md text-title-md text-on-surface font-semibold mt-2">Kesalahan Pesanan</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Nol salah catat dari pelayan ke dapur berkat integrasi input pelanggan.</p>
                    </div>
                    <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                        <span class="font-display-lg text-display-lg-mobile lg:text-display-lg text-primary font-bold tracking-tight">+25%</span>
                        <p class="font-title-md text-title-md text-on-surface font-semibold mt-2">Peningkatan Nilai Order</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Visual menu memicu upsell otomatis pada hidangan pembuka dan minuman.</p>
                    </div>
                    <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                        <span class="font-display-lg text-display-lg-mobile lg:text-display-lg text-primary font-bold tracking-tight">&lt; 2 Menit</span>
                        <p class="font-title-md text-title-md text-on-surface font-semibold mt-2">Waktu Tunggu Pesan</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Tamu duduk dan makanan langsung dimasak tanpa jeda menunggu pelayan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 6: TESTIMONIAL SHOWCASE -->
        <section class="w-full bg-surface-container-low/30 py-24">
            <div class="max-w-5xl mx-auto px-6 lg:px-12">
                <div class="bg-surface-container-lowest rounded-3xl p-8 sm:p-12 lg:p-16 relative overflow-hidden shadow-md border border-surface-container-high">
                    <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-surface-container-high/50 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="flex items-center gap-1 text-[#F59E0B] mb-6">
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <blockquote class="font-headline-md text-headline-sm lg:text-headline-md text-on-surface font-semibold leading-snug">
                    “Sebelum menggunakan UNQUEUE, jam sibuk kedai kopi dan bistro kami adalah medan perang antara kasir, barista, dan koki karena tiket kertas sering basah atau terselip. Sekarang, seluruh alur 45 meja kami tersinkronisasi mulus di layar KDS. Omzet bulanan melonjak 32% dalam kuartal pertama.”
                    </blockquote>
                    <div class="mt-8 pt-8 flex items-center justify-between flex-wrap gap-4 border-t border-outline-variant/30">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary flex items-center justify-center font-title-md text-title-md font-bold">RA</div>
                            <div>
                                <p class="font-title-md text-title-md text-on-surface font-bold">Reza Ardiansyah</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Managing Director &amp; Executive Chef, Le Bistro &amp; Coffee Roasters Jakarta</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-surface-container shadow-sm">
                            <span class="material-symbols-outlined text-primary text-[18px]">storefront</span>
                            <span class="font-label-md text-label-md text-on-surface font-semibold">4 Outlet Aktif Terintegrasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 7: HIGH-CONVERSION BANNER CTA -->
        <section class="w-full bg-surface pb-24" id="subscription-section">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="relative rounded-3xl bg-gradient-to-br from-primary via-primary-container to-secondary overflow-hidden px-8 py-16 lg:py-20 text-center shadow-2xl">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-secondary-fixed/20 rounded-full blur-[100px] pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-on-primary-container/10 rounded-full blur-[90px] pointer-events-none"></div>
                    <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-on-primary/10 text-on-primary font-label-md text-label-md font-semibold backdrop-blur-md">🚀 Langganan Terjangkau Rp 150.000 / bulan</span>
                        <h2 class="font-display-lg text-display-lg-mobile lg:text-display-lg text-on-primary font-bold tracking-tight">Siap Menghadirkan Pengalaman Makan Tanpa Antre di Restoran Anda?</h2>
                        <p class="font-body-lg text-body-lg text-on-primary-container max-w-xl mx-auto">Bergabunglah dengan ribuan pemilik restoran dan coffee shop yang telah memangkas waktu tunggu meja dan meningkatkan omzet dengan UNQUEUE. Hanya Rp 150K / bulan tanpa biaya tersembunyi.</p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl font-label-lg text-label-lg bg-surface-container-lowest text-primary shadow-lg hover:bg-surface-container-low transition-all duration-200 active:scale-95 font-bold text-center">Daftar Sekarang</a>
                            <button class="w-full sm:w-auto px-7 py-4 rounded-xl font-label-lg text-label-lg bg-transparent text-on-primary hover:bg-on-primary/10 transition-colors duration-200 font-semibold" onclick="document.getElementById('demo-modal').classList.remove('hidden')" type="button">Hubungi Spesialis F&amp;B Kami</button>
                        </div>
                        <div class="flex items-center justify-center gap-6 pt-4 text-on-primary/80 font-body-sm text-body-sm">
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">check</span> Setup kilat dalam 24 jam</span>
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">check</span> Tanpa biaya instalasi awal</span>
                            <span class="flex items-center gap-1.5 hidden sm:inline-flex"><span class="material-symbols-outlined text-[16px]">check</span> Support 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- MODAL: LIVE DEMO SCHEDULE -->
        <div class="hidden fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/40 backdrop-blur-sm p-4" id="demo-modal">
            <div class="bg-surface-container-lowest rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl relative">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Jadwalkan Live Demo</h3>
                    <button class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface" onclick="document.getElementById('demo-modal').classList.add('hidden')" type="button">
                        <span class="material-symbols-outlined text-[20px]">close</span>
                    </button>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant mb-6">Tim spesialis UNQUEUE akan menunjukkan alur pemesanan meja dan KDS langsung melalui sesi privat Google Meet selama 20 menit.</p>
                <form class="space-y-4" onsubmit="event.preventDefault(); alert('Jadwal demo Anda telah dikonfirmasi! Tim kami akan menghubungi dalam 15 menit.'); document.getElementById('demo-modal').classList.add('hidden');">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1 font-semibold">Nama Restoran / Usaha</label>
                        <input class="w-full px-4 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container" placeholder="Contoh: Kopi Senja &amp; Eatery" required="" type="text">
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1 font-semibold">Nomor WhatsApp PIC</label>
                        <input class="w-full px-4 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container" placeholder="0812-xxxx-xxxx" required="" type="tel">
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-1 font-semibold">Kategori Bisnis &amp; Jumlah Meja</label>
                        <select class="w-full px-4 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface focus:outline-none focus:ring-2 focus:ring-primary-container">
                            <option>Coffee Shop &amp; Bakery (&lt; 15 Meja)</option>
                            <option>Casual Dining &amp; Restoran (16 - 40 Meja)</option>
                            <option>Fine Dining &amp; Lounge (&gt; 40 Meja)</option>
                            <option>Multi-Outlet Franchise</option>
                        </select>
                    </div>
                    <button class="w-full mt-2 py-3 rounded-xl font-label-lg text-label-lg bg-primary-container text-on-primary font-bold hover:bg-primary transition-colors" type="submit">Konfirmasi Waktu Demo</button>
                </form>
            </div>
        </div>
    </div>
</main>
<footer class="w-full bg-surface-container-lowest shadow-[0_-1px_8px_rgba(0,0,0,0.03)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 pt-16 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold text-2xl">⚡ UNQUEUE</span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-sm">Sistem pemesanan restoran digital pintar dan otomatisasi rotasi meja. Menghadirkan ritme layanan tanpa antrean dan pengalaman kuliner berkelas.</p>
                <div class="pt-2">
                    <p class="font-label-md text-label-md text-on-surface mb-2 font-semibold">Berlangganan Wawasan &amp; Inovasi F&amp;B</p>
                    <div class="flex max-w-md gap-2">
                        <input class="flex-1 px-4 py-2.5 rounded-xl bg-surface-container-low font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary-container" placeholder="Masukkan alamat email bisnis Anda" type="email">
                        <button class="px-4 py-2.5 rounded-xl font-label-lg text-label-lg bg-primary-container text-on-primary hover:bg-primary transition-colors shrink-0 font-semibold" type="button">Langganan</button>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <p class="font-title-md text-title-md text-on-surface font-semibold">Produk</p>
                <ul class="space-y-2.5">
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">QR Table Order</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Kitchen Display Sync</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Smart Waitlist &amp; Queue</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Digital Bill &amp; Payment</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">POS Connector API</li>
                </ul>
            </div>
            <div class="space-y-4">
                <p class="font-title-md text-title-md text-on-surface font-semibold">Solusi F&amp;B</p>
                <ul class="space-y-2.5">
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Fine Dining &amp; Bistro</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Specialty Coffee &amp; Bakery</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Multi-Outlet Franchise</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Casual Fast-Service</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Hotel &amp; Lounge Bars</li>
                </ul>
            </div>
            <div class="space-y-4">
                <p class="font-title-md text-title-md text-on-surface font-semibold">Legalitas &amp; Panduan</p>
                <ul class="space-y-2.5">
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Kebijakan Privasi Data</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Syarat Layanan Merchant</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Kepatuhan PCI-DSS &amp; Enkripsi SSL</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Pusat Bantuan Restoran</li>
                    <li class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors cursor-pointer">Status Server &amp; SLA</li>
                </ul>
            </div>
        </div>
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 bg-surface-container-low/40 px-6 py-4 rounded-2xl">
            <p class="font-body-sm text-body-sm text-on-surface-variant">© 2026 UNQUEUE Systems Inc. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-6 font-body-sm text-body-sm text-on-surface-variant">
                <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-secondary-container inline-block animate-pulse"></span> Sistem Beroperasi Normal</span>
                <span class="">Enkripsi SSL 256-bit &amp; PCI-DSS Compliant</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
