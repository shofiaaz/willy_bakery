@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2">Transaksi Penjualan Hari Ini</h1>
                <p class="text-bread-600">Kelola dan pantau semua transaksi penjualan harian</p>
            </div>
            <a href="{{ route('owner.sales.create') }}"
                class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                Tambah Transaksi Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-bread-50 text-bread-600 mr-4">
                        <i class="fas fa-shopping-cart text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Transaksi</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $sales->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-bread-50 text-bread-600 mr-4">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Produk Terjual</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $sales->sum('quantity') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-bread-50 text-bread-600 mr-4">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-bread-800">Rp
                            {{ number_format($sales->sum('total'), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-bread-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-bread-100 bg-bread-50">
                <h3 class="text-lg font-semibold text-bread-800">Daftar Transaksi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-bread-50 text-bread-700 text-sm">
                            <th class="py-3 px-6 text-left font-medium">Tanggal</th>
                            <th class="py-3 px-6 text-left font-medium">Pelanggan</th>
                            <th class="py-3 px-6 text-left font-medium">Produk</th>
                            <th class="py-3 px-6 text-left font-medium">Jumlah</th>
                            <th class="py-3 px-6 text-left font-medium">Harga Satuan</th>
                            <th class="py-3 px-6 text-left font-medium">Total</th>
                            <th class="py-3 px-6 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-bread-100">
                        @forelse($sales as $sale)
                            <tr class="hover:bg-bread-25 transition-colors duration-150">
                                <td class="py-4 px-6 text-bread-700">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day mr-2 text-bread-400"></i>
                                        {{ \Carbon\Carbon::parse($sale->sale_date)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-bread-800 font-medium">
                                    <div class="flex items-center">
                                        <i class="fas fa-user mr-2 text-bread-400"></i>
                                        {{ $sale->customer->customer_name }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-bread-700">
                                    <div class="flex items-center">
                                        <i class="fas fa-bread-slice mr-2 text-bread-400"></i>
                                        {{ $sale->product->product_name }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-bread-700">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bread-100 text-bread-800">
                                        {{ $sale->quantity }} pcs
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-bread-700">
                                    Rp {{ number_format($sale->price, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-bread-800">
                                        Rp {{ number_format($sale->total, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <form action="{{ route('owner.sales.destroy', $sale->sale_id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors duration-200">
                                            <i class="fas fa-times mr-1"></i>
                                            Batalkan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center text-bread-500">
                                        <i class="fas fa-shopping-cart text-4xl mb-4 text-bread-300"></i>
                                        <p class="text-lg font-medium mb-2">Belum ada transaksi hari ini</p>
                                        <p class="text-sm">Mulai tambahkan transaksi penjualan baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($sales->hasPages())
                <div class="px-6 py-4 border-t border-bread-100 bg-bread-25">
                    {{ $sales->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>

        <style>
            .bg-bread-25 {
                background-color: rgba(251, 245, 239, 0.5);
            }

            .table th {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
            }

            .table tbody tr:hover {
                background-color: rgba(247, 232, 217, 0.3);
            }

            @media (max-width: 768px) {
                .container {
                    padding-left: 1rem;
                    padding-right: 1rem;
                }

                .table th,
                .table td {
                    padding: 0.75rem 0.5rem;
                }
            }
        </style>
@endsection
