@extends('supplier.layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-bread-800">Dashboard Supplier</h1>
    <p class="text-bread-600 mt-2">
        Lihat riwayat pembelian dan pengiriman terkini dari Owner.
    </p>
</div>

{{-- Tabel Riwayat Pembelian --}}
<div class="bg-white rounded-2xl card-shadow p-6 mb-8">
    <h2 class="text-xl font-semibold text-bread-800 mb-4 flex items-center">
        <i class="fas fa-shopping-cart text-bread-500 mr-2"></i> Riwayat Pembelian
    </h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-bread-200 rounded-lg overflow-hidden">
            <thead class="bg-bread-100 text-bread-800 text-left">
                <tr>
                    <th class="py-3 px-4 border-bread-200">Tanggal</th>
                    <th class="py-3 px-4 border-bread-200">Nomor Pesanan</th>
                    <th class="py-3 px-4 border-bread-200">Total Harga</th>
                    <th class="py-3 px-4 border-bread-200">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchases as $purchase)
                    <tr class="border-t border-bread-200 hover:bg-bread-50">
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($purchase->order_date)->format('d M Y') }}</td>
                        <td class="py-3 px-4 font-medium text-bread-800">
                            #{{ str_pad($purchase->order_id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="py-3 px-4 text-bread-700">
                            Rp{{ number_format($purchase->total_price, 2, ',', '.') }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-sm
                                @if($purchase->status == 'Completed') bg-green-100 text-green-700
                                @elseif($purchase->status == 'Pending') bg-yellow-100 text-yellow-700
                                @elseif($purchase->status == 'Cancelled') bg-gray-100 text-gray-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-bread-500">
                            Belum ada data pembelian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Tabel Riwayat Pengiriman --}}
<div class="bg-white rounded-2xl card-shadow p-6">
    <h2 class="text-xl font-semibold text-bread-800 mb-4 flex items-center">
        <i class="fas fa-truck text-bread-500 mr-2"></i> Riwayat Pengiriman
    </h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-bread-200 rounded-lg overflow-hidden">
            <thead class="bg-bread-100 text-bread-800 text-left">
                <tr>
                    <th class="py-3 px-4 border-bread-200">Tanggal Pengiriman</th>
                    <th class="py-3 px-4 border-bread-200">Nomor Pesanan</th>
                    <th class="py-3 px-4 border-bread-200">Status Pengiriman</th>
                    <th class="py-3 px-4 border-bread-200">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deliveries as $delivery)
                    <tr class="border-t border-bread-200 hover:bg-bread-50">
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d M Y') }}</td>
                        <td class="py-3 px-4 font-medium text-bread-800">{{ $delivery->order_number }}</td>
                        <td class="py-3 px-4">
                            <span class="px-3 py-1 rounded-full text-sm
                                @if($delivery->status == 'delivered') bg-green-100 text-green-700
                                @elseif($delivery->status == 'in_transit') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($delivery->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-bread-700">{{ $delivery->notes ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-bread-500">Belum ada data pengiriman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
