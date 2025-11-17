@extends('produksi.layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-bread-800">Manajemen Resep Produk</h1>
    <a href="{{ route('produksi.recipe.create') }}"
       class="bg-bread-600 hover:bg-bread-700 text-white px-5 py-3 rounded-xl">
       <i class="fas fa-plus mr-1"></i> Tambah Resep
    </a>
</div>

<div class="bg-white p-6 rounded-2xl card-shadow">
    <table class="w-full table-auto">
        <thead>
            <tr class="text-left border-b">
                <th class="py-3">Produk</th>
                <th class="py-3">Bahan</th>
                <th class="py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-b">
                <td class="py-3 font-semibold">{{ $product->product_name }}</td>
                <td class="py-3">
                    @foreach ($product->recipes as $recipe)
                        <span class="text-bread-700">
                            {{ $recipe->material->material_name }} ({{ $recipe->quantity_needed }})
                        </span><br>
                    @endforeach
                </td>
                <td class="py-3">
                    <a href="{{ route('produksi.recipe.edit', $product->product_id) }}"
                        class="text-blue-600 hover:underline">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
