@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">🧾 Riwayat Pembelian Bahan Baku</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('owner.purchases.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block mb-4">
        ➕ Buat Pesanan Baru
    </a>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border-b">Tanggal</th>
                    <th class="p-3 border-b">Supplier</th>
                    <th class="p-3 border-b">Status</th>
                    <th class="p-3 border-b">Total</th>
                    <th class="p-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $order->order_date }}</td>
                            <td class="p-3">{{ $order->supplier->supplier_name }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-white
                                    {{ $order->status == 'Pending' ? 'bg-yellow-500' :
                    ($order->status == 'Completed' ? 'bg-green-600' : 'bg-gray-400') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="p-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('owner.purchases.edit', $order->order_id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('owner.purchases.destroy', $order->order_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
@endsection
