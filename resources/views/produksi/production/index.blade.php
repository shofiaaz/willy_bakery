@extends('produksi.layouts.app')

@section('content')

<h1 class="text-3xl font-bold text-bread-800 mb-6">Manajemen Produksi</h1>

{{-- ========== FILTER & SEARCH BAR ========== --}}
<div class="bg-white p-6 rounded-xl card-shadow mb-6">

    <form method="GET" action="{{ route('produksi.production.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- Search --}}
        <div>
            <label class="text-bread-700 font-semibold">Cari Produk</label>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama produk..."
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        {{-- Date From --}}
        <div>
            <label class="text-bread-700 font-semibold">Dari Tanggal</label>
            <input type="date" name="from" value="{{ request('from') }}"
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        {{-- Date To --}}
        <div>
            <label class="text-bread-700 font-semibold">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ request('to') }}"
                class="w-full mt-1 p-2 border rounded-lg">
        </div>

        {{-- Buttons --}}
        <div class="flex items-end space-x-2">
            <button class="px-4 py-2 bg-bread-600 text-white rounded-lg hover:bg-bread-700 w-full">
                Filter
            </button>

            <a href="{{ route('produksi.production.index') }}"
                class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 w-full">
                Reset
            </a>
        </div>

    </form>
</div>

{{-- ========== SUMMARY CARDS ========== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

    {{-- Total Production Today --}}
    <div class="bg-white p-6 rounded-xl stat-card card-shadow">
        <h3 class="text-lg font-semibold text-bread-700">Produksi Hari Ini</h3>
        <p class="text-3xl font-bold mt-2 text-bread-800">{{ $todayTotal ?? 0 }}</p>
    </div>

    {{-- Total This Week --}}
    <div class="bg-white p-6 rounded-xl stat-card card-shadow">
        <h3 class="text-lg font-semibold text-bread-700">Produksi Minggu Ini</h3>
        <p class="text-3xl font-bold mt-2 text-bread-800">{{ $weekTotal ?? 0 }}</p>
    </div>

    {{-- Total Items --}}
    <div class="bg-white p-6 rounded-xl stat-card card-shadow">
        <h3 class="text-lg font-semibold text-bread-700">Total Jenis Produk</h3>
        <p class="text-3xl font-bold mt-2 text-bread-800">{{ $productCount ?? 0 }}</p>
    </div>

</div>

{{-- ========== ADD BUTTON ========== --}}
<div class="mb-4">
    <a href="{{ route('produksi.production.create') }}"
        class="px-4 py-2 bg-bread-600 text-white rounded-lg hover:bg-bread-700">
        + Tambah Produksi
    </a>
</div>

{{-- ========== MAIN TABLE ========== --}}
<div class="bg-white p-6 rounded-xl card-shadow overflow-x-auto">

    <table class="min-w-full text-left">
        <thead>
            <tr class="border-b bg-bread-100 text-bread-800">
                <th class="py-3 px-4">Produk</th>
                <th class="py-3 px-4">Tanggal</th>
                <th class="py-3 px-4">Jumlah Diproduksi</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($productions as $prod)
            <tr class="border-b hover:bg-bread-50">

                <td class="py-3 px-4">{{ $prod->product->product_name }}</td>

                <td class="py-3 px-4">{{ $prod->production_date }}</td>

                <td class="py-3 px-4 font-semibold">
                    <span class="px-3 py-1 bg-bread-200 text-bread-800 rounded-lg">
                        {{ $prod->quantity_produced }}
                    </span>
                </td>

                {{-- Status Badge --}}
                <td class="py-3 px-4">
                    @if($prod->status === 'completed')
                        <span class="px-3 py-1 bg-green-200 text-green-800 rounded-lg">Selesai</span>
                    @else
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-lg">{{ ucfirst($prod->status) }}</span>
                    @endif
                </td>

                {{-- Action Buttons --}}
                <td class="py-3 px-4 text-center">

                    <a href="{{ route('produksi.production.edit', $prod->production_id) }}"
                        class="px-3 py-1 bg-bread-500 text-white rounded hover:bg-bread-600">
                        Edit
                    </a>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-4 text-center text-gray-500">
                    Tidak ada data produksi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $productions->links() }}
    </div>

</div>

@endsection
