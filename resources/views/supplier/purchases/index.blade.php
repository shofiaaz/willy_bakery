@extends('supplier.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2 flex items-center">
                <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                    <i class="fas fa-shopping-basket text-bread-600"></i>
                </div>
                Riwayat Pesanan dari Owner
            </h1>
            <p class="text-bread-600">Lihat dan kelola status pesanan pembelian dari Owner</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center">
            <i class="fas fa-check-circle mr-3 text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center">
            <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-bread-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-bread-50 text-bread-700 text-sm">
                        <th class="py-4 px-6 text-left font-medium">Tanggal</th>
                        <th class="py-4 px-6 text-left font-medium">Status</th>
                        <th class="py-4 px-6 text-left font-medium">Total Harga</th>
                        <th class="py-4 px-6 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-bread-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-bread-25 transition-colors duration-150">
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-day mr-2 text-bread-400"></i>
                                    <div>
                                        <div class="font-medium text-bread-800">
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-bread-500">
                                            {{ \Carbon\Carbon::parse($order->order_date)->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                @if($order->status == 'Completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1 text-xs"></i> Selesai
                                    </span>
                                @elseif($order->status == 'Pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1 text-xs"></i> Pending
                                    </span>
                                @elseif($order->status == 'Cancelled')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-times-circle mr-1 text-xs"></i> Dibatalkan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-info-circle mr-1 text-xs"></i> {{ ucfirst($order->status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <div class="font-semibold text-bread-800">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('supplier.purchases.edit', $order->order_id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-sm font-medium transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i> Ubah Status
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 px-6 text-center">
                                <div class="flex flex-col items-center justify-center text-bread-500">
                                    <i class="fas fa-shopping-basket text-4xl mb-4 text-bread-300"></i>
                                    <p class="text-lg font-medium mb-2">Belum ada pesanan</p>
                                    <p class="text-sm mb-4">Owner belum membuat pesanan pembelian untuk Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-bread-100 bg-bread-25">
                {{ $orders->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</div>

<style>
    .bg-bread-25 { background-color: rgba(251, 245, 239, 0.5); }
    .table th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    .table tbody tr:hover { background-color: rgba(247, 232, 217, 0.3); }
</style>
@endsection
