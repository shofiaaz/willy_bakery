@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">📈 Dashboard Owner</h1>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Penjualan</h2>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Supplier</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalSuppliers }}</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Pembelian Bahan Baku</h2>
            <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
        </div>
    </div>
@endsection
