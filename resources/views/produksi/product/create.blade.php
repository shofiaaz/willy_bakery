@extends('produksi.layouts.app')

@section('content')

<h1 class="text-3xl font-bold text-bread-800 mb-6">Tambah Produk</h1>

<div class="bg-white p-6 rounded-2xl card-shadow max-w-xl">

    <form action="{{ route('produksi.product.store') }}" method="POST">
        @csrf

        <label class="block mb-3">
            <span class="font-medium text-bread-800">Nama Produk</span>
            <input name="product_name" required
                    class="w-full p-3 border rounded-xl bg-bread-50">
        </label>

        <label class="block mb-3">
            <span class="font-medium text-bread-800">Deskripsi</span>
            <textarea name="description"
                    class="w-full p-3 border rounded-xl bg-bread-50" rows="4"></textarea>
        </label>

        <label class="block mb-3">
            <span class="font-medium text-bread-800">Harga (Rp)</span>
            <input type="number" name="price" required min="0"
                    class="w-full p-3 border rounded-xl bg-bread-50">
        </label>

        <div class="mt-4 flex space-x-3">
            <button class="bg-bread-600 text-white px-5 py-3 rounded-xl hover:bg-bread-700">
                Simpan
            </button>

            <a href="{{ route('produksi.product.index') }}"
                class="px-5 py-3 rounded-xl border border-bread-300 hover:bg-bread-100">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection