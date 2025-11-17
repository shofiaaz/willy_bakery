<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\InventoryLog;
use Illuminate\Http\Request;

class ProduksiSupplyController extends Controller
{
    public function index()
    {
        $supplies = RawMaterial::orderBy('material_id', 'DESC')->get();
        return view('produksi.supplies.index', compact('supplies'));
    }

    public function create()
    {
        return view('produksi.supplies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:100',
            'unit' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'cost_per_unit' => 'required|numeric|min:0',
        ]);

        $material = RawMaterial::create($validated);

        // Log initial stock
        InventoryLog::create([
            'material_id' => $material->material_id,
            'type' => 'initial_stock',
            'quantity' => $material->stock,
        ]);

        return redirect()->route('produksi.supplies.index')
            ->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $material = RawMaterial::findOrFail($id);
        return view('produksi.supplies.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = RawMaterial::findOrFail($id);

        $validated = $request->validate([
            'material_name' => 'required|string|max:100',
            'unit' => 'nullable|string',
            'cost_per_unit' => 'required|numeric|min:0',
            'stock_change' => 'nullable|integer',
        ]);

        // Update name/unit/cost
        $material->material_name = $validated['material_name'];
        $material->unit = $validated['unit'];
        $material->cost_per_unit = $validated['cost_per_unit'];

        // Stock change (add/subtract)
        if ($request->filled('stock_change') && $validated['stock_change'] != 0) {
            $material->stock += $validated['stock_change'];

            // Log stock change
            InventoryLog::create([
                'material_id' => $material->material_id,
                'type' => $validated['stock_change'] > 0 ? 'stock_added' : 'stock_removed',
                'quantity' => abs($validated['stock_change']),
            ]);
        }

        $material->save();

        return redirect()->route('produksi.supplies.index')
            ->with('success', 'Bahan baku berhasil diperbarui.');
    }
}
