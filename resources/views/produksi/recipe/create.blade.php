@extends('produksi.layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-bread-800 mb-6">Tambah Resep Produk</h1>

<form action="{{ route('produksi.recipe.store') }}" method="POST" class="bg-white p-6 rounded-2xl card-shadow">
    @csrf

    <label class="block mb-4 font-semibold text-bread-700">Pilih Produk</label>
    <select name="product_id" class="w-full border p-3 rounded-xl mb-6">
        @foreach ($products as $p)
            <option value="{{ $p->product_id }}">{{ $p->product_name }}</option>
        @endforeach
    </select>

    <h3 class="text-lg font-bold text-bread-800 mb-3">Bahan Baku</h3>

    <div id="material-container">
        <div class="flex gap-3 mb-3">
            <select name="material_id[]" class="border p-3 rounded-xl w-1/2">
                @foreach ($materials as $m)
                    <option value="{{ $m->material_id }}">{{ $m->material_name }}</option>
                @endforeach
            </select>

            <input type="number" name="quantity_needed[]" placeholder="Kuantitas"
                class="border p-3 rounded-xl w-1/2">
        </div>
    </div>

    <button type="button" id="addRow"
        class="bg-bread-500 hover:bg-bread-600 text-white px-4 py-2 rounded-lg mb-4">
        <i class="fas fa-plus"></i> Tambah Bahan
    </button>

    <button class="bg-bread-600 hover:bg-bread-700 text-white px-6 py-3 rounded-xl">
        Simpan Resep
    </button>
</form>

@push('scripts')
<script>
document.getElementById('addRow').addEventListener('click', function() {
    let container = document.getElementById('material-container');
    let row = container.children[0].cloneNode(true);
    container.appendChild(row);
});
</script>
@endpush
@endsection
