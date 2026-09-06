<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang.
     */
    public function index()
    {
        if (! session('customer_shop_id')) {
            return view('customer.scan_required');
        }

        $cart      = session('cart', []);
        $cartCount = array_sum(array_column($cart, 'qty'));
        $subtotal  = $this->calculateSubtotal($cart);
        $shopName  = session('customer_shop_name');
        $tableName = session('customer_table_name');

        return view('customer.cart', compact('cart', 'cartCount', 'subtotal', 'shopName', 'tableName'));
    }

    /**
     * Tambah item ke keranjang.
     * Payload: { menu_item_id, qty, note, selected_modifiers: [{modifier_id, option_label, option_price}] }
     */
    public function add(Request $request)
    {
        if (! session('customer_shop_id')) {
            return response()->json(['error' => 'Session expired'], 403);
        }

        $request->validate([
            'menu_item_id'       => 'required|exists:menu_items,id',
            'qty'                => 'required|integer|min:1',
            'note'               => 'nullable|string|max:255',
            'selected_modifiers' => 'nullable|array',
        ]);

        $menuItem   = MenuItem::with('modifiers')->findOrFail($request->menu_item_id);
        $modifiers  = $request->selected_modifiers ?? [];

        // Hitung harga modifier
        $modifierPrice = 0;
        $modifierLabel = [];
        foreach ($modifiers as $mod) {
            $modifierPrice += (float) ($mod['option_price'] ?? 0);
            $modifierLabel[] = ($mod['modifier_name'] ?? '') . ': ' . ($mod['option_label'] ?? '');
        }

        // Buat unique key per kombinasi item + modifier (agar item yg sama tapi beda modifier bisa beda baris)
        $key = $menuItem->id . '_' . md5(json_encode($modifiers));

        $cart = session('cart', []);

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty;
        } else {
            $cart[$key] = [
                'key'            => $key,
                'menu_item_id'   => $menuItem->id,
                'name'           => $menuItem->name,
                'base_price'     => $menuItem->price,
                'modifier_price' => $modifierPrice,
                'unit_price'     => $menuItem->price + $modifierPrice,
                'modifier_label' => implode(', ', $modifierLabel),
                'modifiers'      => $modifiers, // Simpan lengkap untuk snapshot saat checkout
                'note'           => $request->note,
                'qty'            => $request->qty,
            ];
        }

        session(['cart' => $cart]);

        $cartCount = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'success'    => true,
            'cart_count' => $cartCount,
            'message'    => "{$menuItem->name} ditambahkan ke keranjang!",
        ]);
    }

    /**
     * Update qty item di keranjang.
     */
    public function update(Request $request, string $key)
    {
        $request->validate(['qty' => 'required|integer|min:0']);

        $cart = session('cart', []);

        if ($request->qty == 0) {
            unset($cart[$key]);
        } elseif (isset($cart[$key])) {
            $cart[$key]['qty'] = $request->qty;
        }

        session(['cart' => $cart]);

        $subtotal  = $this->calculateSubtotal($cart);
        $cartCount = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'success'    => true,
            'cart_count' => $cartCount,
            'subtotal'   => $subtotal,
            'formatted'  => 'Rp ' . number_format($subtotal, 0, ',', '.'),
        ]);
    }

    /**
     * Hapus item dari keranjang.
     */
    public function remove(string $key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);

        $cartCount = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'success'    => true,
            'cart_count' => $cartCount,
        ]);
    }

    // ─── Helper ─────────────────────────────────────────────────────────────────

    private function calculateSubtotal(array $cart): float
    {
        return array_sum(array_map(fn($item) => $item['unit_price'] * $item['qty'], $cart));
    }
}
