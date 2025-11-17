@extends('produksi.layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-bread-800 mb-6">Edit Produksi</h1>

<div class="bg-white p-6 rounded-xl card-shadow">

    {{-- BACK BUTTON --}}
    <a href="{{ route('produksi.production.index') }}"
        class="px-4 py-2 bg-gray-300 text-bread-800 rounded-lg hover:bg-gray-400">
        ← Kembali
    </a>

    {{-- UPDATE FORM --}}
    <form action="{{ route('produksi.production.update', $production->production_id) }}"
          method="POST" class="mt-6">
        @csrf
        @method('PUT')

        {{-- PRODUK (LOCKED) --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Produk</label>
            <input type="text" disabled
                value="{{ $production->product->product_name }}"
                class="w-full p-3 bg-gray-100 border rounded-lg">
        </div>

        {{-- TANGGAL PRODUKSI --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Tanggal Produksi</label>
            <input type="date" name="production_date"
                value="{{ $production->production_date }}"
                class="w-full p-3 border rounded-lg">
        </div>

        {{-- JUMLAH DIPRODUKSI --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Jumlah Diproduksi</label>
            <input type="number" name="quantity_produced"
                value="{{ $production->quantity_produced }}"
                min="1" class="w-full p-3 border rounded-lg">
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            <label class="font-semibold text-bread-700">Status</label>
            <select name="status" class="w-full p-3 border rounded-lg">
                <option value="completed" {{ $production->status == 'completed' ? 'selected' : '' }}>
                    Selesai
                </option>
                <option value="in_progress" {{ $production->status == 'in_progress' ? 'selected' : '' }}>
                    Sedang Berjalan
                </option>
                <option value="pending" {{ $production->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
            </select>
        </div>

        {{-- UPDATE BUTTON --}}
        <button class="px-5 py-3 bg-bread-600 text-white rounded-lg hover:bg-bread-700">
            Simpan Perubahan
        </button>
    </form>

    {{-- =============================
        DELETE FORM 
    ============================= --}}
    <form action="{{ route('produksi.production.destroy', $production->production_id) }}"
            method="POST"
            class="mt-4"
            onsubmit="return confirm('Yakin ingin menghapus data produksi ini? Stok akan dikembalikan.')">
        @csrf
        @method('DELETE')

        <button class="px-5 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600">
            Hapus Produksi
        </button>
    </form>

</div>
@endsection
