@extends('supplier.layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <h1 class="text-2xl font-bold text-bread-800 mb-4">Edit Status Pesanan</h1>

    <form action="{{ route('supplier.purchases.update', $order->order_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-sm font-medium text-bread-700 mb-2">Status Pesanan</label>
            <select name="status" class="border rounded-lg p-3 w-full">
                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('supplier.purchases.index') }}"
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-bread-800">
                Batal
            </a>
            <button type="submit"
                class="px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white rounded-lg">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
