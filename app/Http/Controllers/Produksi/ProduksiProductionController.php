<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\DailyProduction;
use App\Models\ProductRecipe;
use App\Models\ProductUsage;
use App\Models\RawMaterial;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiProductionController extends Controller
{
    public function index(Request $request)
    {
        $query = DailyProduction::with('product');

        if ($request->search) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->from) {
            $query->where('production_date', '>=', $request->from);
        }

        if ($request->to) {
            $query->where('production_date', '<=', $request->to);
        }

        $productions = $query->orderBy('production_date', 'DESC')->paginate(10);

        // SUMMARY
        $today = now()->toDateString();

        $todayTotal = DailyProduction::whereDate('production_date', $today)
            ->sum('quantity_produced');

        $weekTotal = DailyProduction::whereBetween('production_date', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ])->sum('quantity_produced');

        $productCount = DailyProduction::distinct('product_id')->count('product_id');

        return view('produksi.production.index', compact(
            'productions',
            'todayTotal',
            'weekTotal',
            'productCount'
        ));
    }

    public function create()
    {
        $products = Product::all();
        $recipes = ProductRecipe::with('material')->get()->groupBy('product_id');

        return view('produksi.production.create', compact('products', 'recipes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'production_date' => 'required|date',
            'quantity_produced' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($request->product_id);

            $recipes = ProductRecipe::where('product_id', $product->product_id)->get();

            foreach ($recipes as $recipe) {
                $material = RawMaterial::find($recipe->material_id);

                if (!$material) {
                    DB::rollBack();
                    return back()->with('error', 'Bahan baku tidak ditemukan!');
                }

                $needed = $recipe->quantity_needed * $request->quantity_produced;

                if ($material->stock < $needed) {
                    DB::rollBack();
                    return back()->with(
                        'error',
                        "Stok bahan {$material->material_name} tidak cukup! Dibutuhkan $needed, tersedia {$material->stock}"
                    );
                }

                // Reduce stock
                $material->stock -= $needed;
                $material->save();

                // Log usage
                InventoryLog::create([
                    'product_id' => $product->product_id,
                    'material_id' => $material->material_id,
                    'type' => 'consumption',
                    'quantity' => $needed,
                ]);

                // SAVE USAGE RECORD (THIS WAS MISSING BEFORE)
                ProductUsage::create([
                    'product_id' => $product->product_id,
                    'material_id' => $material->material_id,
                    'quantity_used' => $needed,
                    'usage_date' => $request->production_date,
                ]);
            }

            // Create production
            DailyProduction::create([
                'product_id' => $product->product_id,
                'production_date' => $request->production_date,
                'quantity_produced' => $request->quantity_produced,
                'status' => 'completed',
            ]);

            // ADD STOCK TO PRODUCT
            $product->stock += $request->quantity_produced;
            $product->save();

            // Log
            InventoryLog::create([
                'product_id' => $product->product_id,
                'material_id' => null,
                'type' => 'product_created',
                'quantity' => $request->quantity_produced,
            ]);

            DB::commit();

            return redirect()->route('produksi.production.index')
                ->with('success', 'Produksi berhasil dicatat!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(DailyProduction $production)
    {
        $products = Product::all();
        return view('produksi.production.edit', compact('production', 'products'));
    }

    public function update(Request $request, DailyProduction $production)
    {
        $request->validate([
            'production_date' => 'required|date',
            'quantity_produced' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $oldQty = $production->quantity_produced;
            $newQty = $request->quantity_produced;
            $difference = $newQty - $oldQty;

            $product = $production->product;

            // ========= UPDATE PRODUCT STOCK =========
            if ($difference != 0) {
                if ($difference > 0) {
                    // Add stock
                    $product->stock += $difference;

                    InventoryLog::create([
                        'product_id' => $product->product_id,
                        'material_id' => null,
                        'type' => 'product_created',
                        'quantity' => $difference,
                    ]);
                } else {
                    // Return stock
                    $product->stock += $difference;

                    InventoryLog::create([
                        'product_id' => $product->product_id,
                        'material_id' => null,
                        'type' => 'product_return',
                        'quantity' => $difference,
                    ]);
                }

                $product->save();
            }

            // ========= UPDATE MATERIAL USAGE =========
            $recipes = ProductRecipe::where('product_id', $product->product_id)->get();

            foreach ($recipes as $recipe) {
                $material = RawMaterial::find($recipe->material_id);
                $perUnit = $recipe->quantity_needed;

                $oldUse = $oldQty * $perUnit;
                $newUse = $newQty * $perUnit;
                $uDiff = $newUse - $oldUse;

                if ($uDiff > 0) {
                    if ($material->stock < $uDiff) {
                        DB::rollBack();
                        return back()->with('error', "Stok bahan {$material->material_name} tidak cukup!");
                    }

                    $material->stock -= $uDiff;
                    $material->save();

                    InventoryLog::create([
                        'product_id' => $product->product_id,
                        'material_id' => $material->material_id,
                        'type' => 'consumption',
                        'quantity' => $uDiff,
                    ]);
                }

                if ($uDiff < 0) {
                    $material->stock += abs($uDiff);
                    $material->save();

                    InventoryLog::create([
                        'product_id' => $product->product_id,
                        'material_id' => $material->material_id,
                        'type' => 'restock',
                        'quantity' => abs($uDiff),
                    ]);
                }

                // UPDATE ProductUsage
                ProductUsage::where('product_id', $product->product_id)
                    ->where('material_id', $material->material_id)
                    ->where('usage_date', $production->production_date)
                    ->update([
                        'quantity_used' => $newUse
                    ]);
            }

            // Update production record
            $production->update([
                'production_date' => $request->production_date,
                'quantity_produced' => $newQty,
            ]);

            DB::commit();

            return redirect()
                ->route('produksi.production.index')
                ->with('success', 'Produksi berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $production = DailyProduction::findOrFail($id);
            $product = $production->product;

            // Restore product stock
            $product->stock -= $production->quantity_produced;
            $product->save();

            InventoryLog::create([
                'product_id' => $production->product_id,
                'material_id' => null,
                'type' => 'product_return',
                'quantity' => -$production->quantity_produced,
            ]);

            // FIXED: Use usage_date, NOT created_at
            $usages = ProductUsage::where('product_id', $production->product_id)
                ->where('usage_date', $production->production_date)
                ->get();

            foreach ($usages as $usage) {
                $material = RawMaterial::find($usage->material_id);

                if ($material) {
                    $material->stock += $usage->quantity_used;
                    $material->save();

                    InventoryLog::create([
                        'product_id' => $production->product_id,
                        'material_id' => $usage->material_id,
                        'type' => 'restock',
                        'quantity' => $usage->quantity_used,
                    ]);
                }

                $usage->delete();
            }

            $production->delete();

            DB::commit();

            return redirect()
                ->route('produksi.production.index')
                ->with('success', 'Produksi berhasil dihapus dan stok dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
