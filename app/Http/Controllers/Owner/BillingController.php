<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $subscriptions = $shop->subscriptions()->latest()->take(5)->get();
        return view('owner.billing.index', compact('shop', 'subscriptions'));
    }

    public function expired(Request $request)
    {
        $shop = $request->user()->activeShop();
        return view('owner.billing.expired', compact('shop'));
    }

    public function subscribe(Request $request)
    {
        // Placeholder — akan diimplementasikan di Fase Xendit
        return back()->with('info', 'Fitur pembayaran segera hadir!');
    }
}
