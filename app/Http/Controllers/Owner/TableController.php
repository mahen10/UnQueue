<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;

class TableController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $tables = Table::where('shop_id', $shop->id)->orderBy('number')->get();
        return view('owner.tables.index', compact('tables', 'shop'));
    }

    public function create()
    {
        return view('owner.tables.create');
    }

    public function store(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|min:1',
        ]);

        Table::create([
            'shop_id' => $shop->id,
            'name' => $request->name,
            'number' => $request->number,
        ]);

        return redirect()->route('owner.tables.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function edit(Table $table)
    {
        return view('owner.tables.edit', compact('table'));
    }

    public function update(Request $request, Table $table)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|integer|min:1',
        ]);

        $table->update([
            'name' => $request->name,
            'number' => $request->number,
        ]);

        return redirect()->route('owner.tables.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('owner.tables.index')->with('success', 'Meja berhasil dihapus.');
    }

    public function downloadQr(Table $table)
    {
        // Pastikan format base64 aman untuk view / PDF
        $qrCode = base64_encode(QrCode::format('svg')->size(300)->generate($table->qr_url));
        
        $pdf = Pdf::loadView('owner.tables.qr_pdf', compact('table', 'qrCode'));
        
        return $pdf->download("QR-Code-{$table->name}.pdf");
    }

    public function exportAllPdf(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $tables = Table::where('shop_id', $shop->id)->orderBy('number')->get();
        
        $qrs = [];
        foreach($tables as $table) {
            $qrs[$table->id] = base64_encode(QrCode::format('svg')->size(250)->generate($table->qr_url));
        }

        $pdf = Pdf::loadView('owner.tables.qr_all_pdf', compact('tables', 'qrs', 'shop'));
        
        return $pdf->download("All-QR-Codes-{$shop->slug}.pdf");
    }

    public function regenerateToken(Table $table)
    {
        // Force model to generate new token by setting it to null
        $table->qr_token = \Illuminate\Support\Str::random(10);
        $table->save();

        return redirect()->back()->with('success', "Token QR Meja {$table->name} berhasil diperbarui.");
    }
}
