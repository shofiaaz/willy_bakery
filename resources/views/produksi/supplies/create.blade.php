@extends('produksi.layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-bread-800 mb-6">Tambah Bahan Baku</h1>

<div class="bg-white p-6 rounded-xl card-shadow max-w-xl">
    <form action="{{ route('produksi.supplies.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-semibold text-bread-700">Nama Bahan</label>
            <input type="text" name="material_name" required
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="font-semibold text-bread-700">Stok Awal</label>
            <input type="number" name="stock" min="0" required
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="font-semibold text-bread-700">Satuan</label>
            <input type="text" name="unit"
                class="w-full mt-1 p-2 border rounded-lg" placeholder="Kg, Gram, Liter ...">
        </div>

        <div class="mb-4">
            <label class="font-semibold text-bread-700">Biaya / Unit</label>
            <input type="number" step="0.01" name="cost_per_unit" required
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('produksi.supplies.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>
            <button class="px-4 py-2 bg-bread-600 text-white rounded-lg hover:bg-bread-700">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection