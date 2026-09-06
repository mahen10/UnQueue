<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua QR Code - {{ $shop->name }}</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        .page-break { page-break-after: always; }
        .container { border: 2px dashed #ccc; padding: 40px; border-radius: 10px; max-width: 400px; margin: 50px auto; }
        h1 { margin-bottom: 5px; color: #333; }
        p { color: #666; margin-bottom: 30px; }
        .qr-wrapper { background: #fff; padding: 20px; border-radius: 10px; display: inline-block; }
        .footer { margin-top: 30px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    @foreach($tables as $index => $table)
    <div class="container">
        <h1>{{ $table->name }}</h1>
        <p>Scan untuk memesan menu</p>
        
        <div class="qr-wrapper">
            <img src="data:image/svg+xml;base64,{{ $qrs[$table->id] }}" alt="QR Code" width="250" height="250">
        </div>
        
        <div class="footer">
            <p>{{ $shop->name }}</p>
            <p>Atau kunjungi:<br><strong>{{ $table->qr_url }}</strong></p>
        </div>
    </div>
    
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>
