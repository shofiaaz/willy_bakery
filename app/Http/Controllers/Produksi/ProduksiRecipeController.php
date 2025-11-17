<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;

class ProduksiRecipeController extends Controller
{
    public function index()
    {
        $products = Product::with('recipes.material')->get();

        return view('produksi.recipe.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        $materials = RawMaterial::all();

        return view('produksi.recipe.create', compact('products', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'material_id.*' => 'required|exists:raw_materials,material_id',
            'quantity_needed.*' => 'required|numeric|min:1',
        ]);

        foreach ($request->material_id as $index => $materialId) {
            ProductRecipe::create([
                'product_id' => $request->product_id,
                'material_id' => $materialId,
                'quantity_needed' => $request->quantity_needed[$index],
            ]);
        }

        return redirect()->route('produksi.recipe.index')
            ->with('success', 'Resep produk berhasil ditambahkan!');
    }

    public function edit($productId)
    {
        $product = Product::with('recipes.material')->findOrFail($productId);
        $materials = RawMaterial::all();

        return view('produksi.recipe.edit', compact('product', 'materials'));
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'material_id.*' => 'required|exists:raw_materials,material_id',
            'quantity_needed.*' => 'required|numeric|min:1',
        ]);

        ProductRecipe::where('product_id', $productId)->delete();

        foreach ($request->material_id as $index => $materialId) {
            ProductRecipe::create([
                'product_id' => $productId,
                'material_id' => $materialId,
                'quantity_needed' => $request->quantity_needed[$index],
            ]);
        }

        return redirect()->route('produksi.recipe.index')
            ->with('success', 'Resep produk berhasil diperbarui!');
    }

    public function destroy($recipeId)
    {
        ProductRecipe::findOrFail($recipeId)->delete();

        return back()->with('success', 'Item resep berhasil dihapus!');
    }
}
