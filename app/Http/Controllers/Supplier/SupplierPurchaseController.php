<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\PurchaserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierPurchaseController extends Controller
{
    public function index()
    {
        $supplierId = Auth::guard('supplier')->id();
        $orders = PurchaserOrder::with('items')
            ->where('supplier_id', $supplierId)
            ->latest()
            ->paginate(10);

        return view('supplier.purchases.index', compact('orders'));
    }

    public function edit($id)
    {
        $supplierId = Auth::guard('supplier')->id();
        $order = PurchaserOrder::where('supplier_id', $supplierId)
            ->with('items')
            ->findOrFail($id);

        return view('supplier.purchases.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Completed,Cancelled',
        ]);

        $supplierId = Auth::guard('supplier')->id();
        $order = PurchaserOrder::where('supplier_id', $supplierId)->findOrFail($id);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('supplier.purchases.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
