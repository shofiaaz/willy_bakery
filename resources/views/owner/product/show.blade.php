@extends('owner.layouts.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow p-6">
    <h1 class="text-3xl font-bold mb-4 text-bread-800">{{ $product->product_name }}</h1>

    <div class="mb-4">
        <p class="text-gray-700"><strong>Deskripsi:</strong> {{ $product->description ?? '-' }}</p>
    </div>

    <div class="mb-4">
        <p class="text-gray-700"><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    </div>

    <div class="mb-4">
        <p class="text-gray-700"><strong>Stok Tersedia:</strong> {{ $product->stock }}</p>
    </div>

    <a href="{{ route('owner.stock.index') }}" class="bg-bread-600 text-white px-5 py-3 rounded-xl hover:bg-bread-700">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>
@endsection
