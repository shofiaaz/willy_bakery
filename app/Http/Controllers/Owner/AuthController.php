<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('owner.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'owner') {
                return redirect()->route('owner.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Anda tidak memiliki akses ke halaman owner.']);
            }
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('owner.login');
    }
}
