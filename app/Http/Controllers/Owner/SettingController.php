<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(Request $request)
    {
        $shop = $request->attributes->get('shop');
        return view('owner.settings.edit', compact('shop'));
    }

    public function update(Request $request)
    {
        $shop = $request->attributes->get('shop');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'tax_percent' => 'required|numeric|min:0|max:100',
            'service_charge_percent' => 'required|numeric|min:0|max:100',
            // Xendit setup
            'xendit_public_key' => 'nullable|string',
            'xendit_secret_key' => 'nullable|string',
        ]);

        // Jika user mengisi secret key baru, maka kita encrypt
        if ($request->filled('xendit_secret_key')) {
            $validated['xendit_secret_key'] = encrypt($request->xendit_secret_key);
        } else {
            // Jangan timpa jika dikosongkan
            unset($validated['xendit_secret_key']);
        }

        $shop->update($validated);

        return redirect()->route('owner.settings.edit')->with('success', 'Pengaturan toko berhasil diperbarui.');
    }
}
