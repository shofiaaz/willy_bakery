@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-shopping-basket text-bread-600"></i>
                    </div>
                    Riwayat Pembelian Bahan Baku
                </h1>
                <p class="text-bread-600">Kelola dan pantau semua pembelian bahan baku</p>
            </div>
            <a href="{{ route('owner.purchases.create') }}"
                class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Pesanan Baru
            </a>
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-bread-50 text-bread-600 mr-4">
                        <i class="fas fa-receipt text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Pesanan</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $orders->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Selesai</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $orders->where('status', 'Completed')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-yellow-50 text-yellow-600 mr-4">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Pending</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $orders->where('status', 'Pending')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-money-bill-wave text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-bread-800">Rp
                            {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h3 class="text-lg font-semibold text-bread-800">Daftar Pembelian</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <input type="text" placeholder="Cari pesanan..."
                            class="pl-10 pr-4 py-2 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 text-sm w-full md:w-64">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-bread-400"></i>
                    </div>
                    <select
                        class="px-4 py-2 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 text-sm bg-white">
                        <option value="">Semua Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-bread-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-bread-50 text-bread-700 text-sm">
                            <th class="py-4 px-6 text-left font-medium">Tanggal</th>
                            <th class="py-4 px-6 text-left font-medium">Supplier</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-left font-medium">Total</th>
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
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-truck text-bread-600 text-xs"></i>
                                        </div>
                                        <span class="font-medium text-bread-800">{{ $order->supplier->supplier_name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    @if($order->status == 'Completed')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1 text-xs"></i>
                                            Selesai
                                        </span>
                                    @elseif($order->status == 'Pending')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1 text-xs"></i>
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-times-circle mr-1 text-xs"></i>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-semibold text-bread-800">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('owner.purchases.edit', $order->order_id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-sm font-medium transition-colors duration-200"
                                            title="Edit Pesanan">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('owner.purchases.destroy', $order->order_id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors duration-200"
                                                title="Hapus Pesanan">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 px-6 text-center">
                                    <div class="flex flex-col items-center justify-center text-bread-500">
                                        <i class="fas fa-shopping-basket text-4xl mb-4 text-bread-300"></i>
                                        <p class="text-lg font-medium mb-2">Belum ada pesanan</p>
                                        <p class="text-sm mb-4">Mulai buat pesanan pembelian pertama Anda</p>
                                        <a href="{{ route('owner.purchases.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white rounded-lg transition-colors duration-200">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Buat Pesanan Baru
                                        </a>
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

            .grid-cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .grid-cols-4 {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
