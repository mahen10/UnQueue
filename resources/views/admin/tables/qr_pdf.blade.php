<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>QR Code - {{ $table->name }}</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 20px; }
        .container { border: 2px dashed #ccc; padding: 40px; border-radius: 10px; max-width: 400px; margin: 0 auto; }
        h1 { margin-bottom: 5px; color: #333; }
        p { color: #666; margin-bottom: 30px; }
        .qr-wrapper { background: #fff; padding: 20px; border-radius: 10px; display: inline-block; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .footer { margin-top: 30px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $table->name }}</h1>
        <p>Scan untuk memesan menu</p>
        
        <div class="qr-wrapper">
            <!-- DomPDF supports SVG via img src data uri or raw XML -->
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" alt="QR Code" width="250" height="250">
        </div>
        
        <div class="footer">
            <p>{{ $table->shop->name }}</p>
            <p>Atau kunjungi:<br><strong>{{ $table->qr_url }}</strong></p>
        </div>
    </div>
</body>
</html>
