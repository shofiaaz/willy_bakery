<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProduksiAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('produksi.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'staff' || $user->role === 'admin') {
                return redirect()->route('produksi.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Anda tidak memiliki akses ke halaman produksi.']);
            }
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('produksi.login');
    }
}
