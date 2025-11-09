<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\SupplierProfile;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::with('profile')->latest()->paginate(10);
        return view('owner.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('owner.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:100',
            'company_type' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $supplier = Supplier::create($request->only(['supplier_name', 'email', 'phone', 'address']));

        SupplierProfile::create([
            'supplier_id' => $supplier->supplier_id,
            'contact_person' => $request->contact_person,
            'company_type' => $request->company_type,
            'notes' => $request->notes,
        ]);

        return redirect()->route('owner.suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $supplier = Supplier::with('profile')->findOrFail($id);
        return view('owner.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:100',
            'company_type' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->only(['supplier_name', 'email', 'phone', 'address']));

        $supplier->profile()->updateOrCreate(
            ['supplier_id' => $supplier->supplier_id],
            [
                'contact_person' => $request->contact_person,
                'company_type' => $request->company_type,
                'notes' => $request->notes,
            ]
        );

        return redirect()->route('owner.suppliers.index')->with('success', 'Data supplier berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->profile()->delete();
        $supplier->delete();

        return redirect()->route('owner.suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
