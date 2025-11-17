<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProduksiProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('product_name')->get();

        return view('produksi.product.index', compact('products'));
    }

    public function create()
    {
        return view('produksi.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => 0, // stock initially 0
        ]);

        return redirect()->route('produksi.product.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('produksi.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('produksi.product.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('produksi.product.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
