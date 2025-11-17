@extends('produksi.layouts.app')

@section('content')

<h1 class="text-2xl font-bold text-bread-800 mb-6">Edit Bahan Baku</h1>

<div class="bg-white p-6 rounded-xl card-shadow max-w-xl">
    <form action="{{ route('produksi.supplies.update', $material->material_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Bahan --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Nama Bahan</label>
            <input 
                type="text" 
                name="material_name" 
                required
                class="w-full mt-1 p-3 border rounded-lg"
                value="{{ $material->material_name }}"
            >
        </div>

        {{-- Stok Sekarang (readonly) --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Stok Saat Ini</label>
            <input 
                type="number" 
                class="w-full mt-1 p-3 border rounded-lg bg-gray-100"
                value="{{ $material->stock }}" 
                readonly
            >
        </div>

        {{-- Ubah stok --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Ubah Stok</label>
            <input 
                type="number" 
                name="stock_change" 
                value="0"
                class="w-full mt-1 p-3 border rounded-lg"
            >
            <p class="text-xs text-gray-500 mt-1">
                Gunakan angka positif untuk menambah, negatif untuk mengurangi stok.
            </p>
        </div>

        {{-- Satuan --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Satuan</label>
            <input 
                type="text" 
                name="unit"
                class="w-full mt-1 p-3 border rounded-lg"
                value="{{ $material->unit }}"
            >
        </div>

        {{-- Biaya per Unit --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Biaya / Unit</label>
            <input 
                type="number" 
                step="0.01" 
                name="cost_per_unit" 
                required
                class="w-full mt-1 p-3 border rounded-lg"
                value="{{ $material->cost_per_unit }}"
            >
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('produksi.supplies.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                Batal
            </a>

            <button
                class="px-4 py-2 bg-bread-600 text-white rounded-lg hover:bg-bread-700">
                Update
            </button>
        </div>

    </form>
</div>

@endsection
