<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\SupplierProfile;
use Illuminate\Http\Request;
class SupplierAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('supplier.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'contact_person' => 'required|string',
            'phone' => 'required|string',
        ]);

        $profile = SupplierProfile::where('contact_person', $request->contact_person)
            ->whereHas('supplier', fn($q) => $q->where('phone', $request->phone))
            ->first();

        if (! $profile) {
            return back()->withErrors(['error' => 'Invalid credentials.']);
        }

        // Login the supplier model (which is authenticatable)
        Auth::guard('supplier')->login($profile->supplier);

        return redirect()->route('supplier.dashboard')
            ->with('success', 'Welcome back, ' . $profile->contact_person . '!');
    }
    public function logout(Request $request)
    {
        Auth::guard('supplier')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('supplier.login')->with('success', 'Berhasil logout.');
    }

}
