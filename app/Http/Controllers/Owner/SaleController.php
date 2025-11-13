<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'product'])
            ->whereDate('sale_date', Carbon::today())
            ->latest()
            ->paginate(10);

        return view('owner.sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('owner.sales.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,customer_id',
            'new_customer_name' => 'nullable|string|max:100',
            'new_customer_phone' => 'nullable|string|max:20',
            'new_customer_email' => 'nullable|email|max:100',
            'new_customer_address' => 'nullable|string|max:255',
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $customerId = $request->customer_id;
            if (!$customerId && $request->filled('new_customer_name')) {
                $newCustomer = Customer::create([
                    'customer_name' => $request->new_customer_name,
                    'email' => $request->new_customer_email,
                    'phone' => $request->new_customer_phone,
                    'address' => $request->new_customer_address,
                ]);
                $customerId = $newCustomer->customer_id;
            }

            if (!$customerId) {
                return back()->with('error', 'Harap pilih pelanggan atau isi pelanggan baru.');
            }

            $product = Product::findOrFail($request->product_id);

            if ($product->stock < $request->quantity) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }

            $total = $request->quantity * $request->price;

            $sale = Sale::create([
                'customer_id' => $customerId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $total,
                'sale_date' => Carbon::now(),
            ]);

            $product->decrement('stock', $request->quantity);

            InventoryLog::create([
                'product_id' => $product->product_id,
                'type' => 'OUT',
                'quantity' => $request->quantity,
                'timestamp' => Carbon::now(),
            ]);

            DB::commit();
            return redirect()->route('owner.sales.index')->with('success', 'Transaksi penjualan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $product = Product::find($sale->product_id);

        DB::beginTransaction();
        try {
            $product->increment('stock', $sale->quantity);

            InventoryLog::create([
                'product_id' => $product->product_id,
                'type' => 'IN',
                'quantity' => $sale->quantity,
                'timestamp' => Carbon::now(),
            ]);

            $sale->delete();

            DB::commit();
            return redirect()->route('owner.sales.index')->with('success', 'Pesanan dibatalkan dan stok dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }
}
