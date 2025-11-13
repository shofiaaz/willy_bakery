<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\InventoryLog;
use App\Models\PurchaserOrder;
use App\Models\PurchaserOrderItem;
use App\Models\RawMaterial;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaserOrderController extends Controller
{
    public function index()
    {
        $orders = PurchaserOrder::with(['supplier', 'items'])
            ->latest()
            ->paginate(10);

        return view('owner.purchases.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $materials = RawMaterial::all();
        return view('owner.purchases.create', compact('suppliers', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'order_date' => 'required|date',
            'materials' => 'required|array',
            'materials.*.material_id' => 'required|exists:raw_materials,material_id',
            'materials.*.quantity' => 'required|numeric|min:1',
            'materials.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $total = collect($request->materials)->sum(function ($item) {
                return $item['quantity'] * $item['price'];
            });

            $order = PurchaserOrder::create([
                'supplier_id' => $request->supplier_id,
                'user_id' => Auth::id(),
                'order_date' => $request->order_date,
                'status' => 'Pending',
                'total_price' => $total,
            ]);

            foreach ($request->materials as $item) {
                PurchaserOrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['material_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);
            }

            DB::commit();
            return redirect()->route('owner.purchases.index')->with('success', 'Pesanan pembelian berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $order = PurchaserOrder::with('items')->findOrFail($id);
        $suppliers = Supplier::all();
        $materials = RawMaterial::all();

        return view('owner.purchases.edit', compact('order', 'suppliers', 'materials'));
    }

    public function update(Request $request, $id)
    {
        $order = PurchaserOrder::findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:50',
            'materials' => 'required|array',
            'materials.*.quantity' => 'required|numeric|min:1',
            'materials.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $previousStatus = $order->status;

            $order->update(['status' => $request->status]);

            $order->items()->delete();

            $total = collect($request->materials)->sum(fn($item) => $item['quantity'] * $item['price']);

            foreach ($request->materials as $item) {
                PurchaserOrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['material_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);
            }

            $order->update(['total_price' => $total]);

            if ($previousStatus !== 'Completed' && $request->status === 'Completed') {
                foreach ($request->materials as $item) {
                    $material = RawMaterial::find($item['material_id']);
                    $oldStock = $material->stock;
                    $material->increment('stock', $item['quantity']);

                    InventoryLog::create([
                        'material_id' => $material->material_id,
                        'user_id' => Auth::id(),
                        'change_type' => 'IN',
                        'quantity_changed' => $item['quantity'],
                        'previous_stock' => $oldStock,
                        'new_stock' => $material->stock,
                        'notes' => 'Penambahan stok dari pesanan pembelian #' . $order->order_id,
                        'created_at' => Carbon::now(),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('owner.purchases.index')->with('success', 'Pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $order = PurchaserOrder::findOrFail($id);
        $order->items()->delete();
        $order->delete();

        return redirect()->route('owner.purchases.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
