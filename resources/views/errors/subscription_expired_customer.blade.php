<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Mandiri Nonaktif</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen px-6">
    <div class="max-w-sm w-full text-center">
        <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-gray-900">Pemesanan Mandiri Sedang Dinonaktifkan</h1>
        <p class="text-gray-500 text-sm mt-3 leading-relaxed">
            Mohon maaf, sistem pemesanan mandiri di <strong>{{ $shop->name }}</strong> sedang tidak tersedia untuk saat ini.
        </p>
        <p class="text-gray-400 text-xs mt-4">
            Silakan panggil pelayan kami untuk melakukan pemesanan. Terima kasih atas pengertian Anda. 🙏
        </p>
    </div>
</body>
</html>
