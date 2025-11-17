@extends('produksi.layouts.app')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-3xl font-bold text-bread-800">Manajemen Produk</h1>

    <a href="{{ route('produksi.product.create') }}"
        class="bg-bread-600 text-white px-5 py-3 rounded-xl hover:bg-bread-700 flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl card-shadow p-6">
    <table class="w-full table-auto">
        <thead>
            <tr class="border-b">
                <th class="text-left p-3">Nama Produk</th>
                <th class="text-left p-3">Stok</th>
                <th class="text-left p-3">Harga</th>
                <th class="text-left p-3 w-32">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr class="border-b hover:bg-bread-50">
                <td class="p-3">{{ $p->product_name }}</td>
                <td class="p-3">{{ $p->stock }}</td>
                <td class="p-3">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                <td class="p-3 flex space-x-3">
                    <a href="{{ route('produksi.product.edit', $p->product_id) }}"
                        class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('produksi.product.destroy', $p->product_id) }}" method="POST"
                        onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection