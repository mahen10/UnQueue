<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreeUserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->activeShop()) {
            return redirect()->route('login'); // Biarkan login controller yang urus redirect ke dashboard yang benar
        }

        return view('free_user.dashboard');
    }
}
