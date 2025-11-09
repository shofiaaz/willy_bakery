@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">🧺 Buat Pesanan Pembelian Bahan Baku</h1>

    <form action="{{ route('owner.purchases.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow max-w-3xl">
        @csrf
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label>Supplier</label>
                <select name="supplier_id" class="border p-2 w-full rounded" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Tanggal Pemesanan</label>
                <input type="date" name="order_date" value="{{ now()->toDateString() }}" class="border p-2 w-full rounded"
                    required>
            </div>
        </div>

        <h2 class="font-semibold mb-2">Daftar Bahan Baku</h2>
        <div id="material-list">
            <div class="flex gap-2 mb-2">
                <select name="materials[0][material_id]" class="border p-2 w-1/2 rounded" required>
                    <option value="">-- Pilih Bahan --</option>
                    @foreach ($materials as $m)
                        <option value="{{ $m->material_id }}">{{ $m->material_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="materials[0][quantity]" placeholder="Jumlah" class="border p-2 w-1/4 rounded"
                    required>
                <input type="number" name="materials[0][price]" placeholder="Harga" class="border p-2 w-1/4 rounded"
                    required>
            </div>
        </div>

        <button type="button" id="addMaterial" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded mb-4">
            ➕ Tambah Bahan
        </button>

        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan Pesanan</button>
    </form>

    <script>
        let i = 1;
        document.getElementById('addMaterial').addEventListener('click', function () {
            const list = document.getElementById('material-list');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mb-2');
            div.innerHTML = `
                <select name="materials[${i}][material_id]" class="border p-2 w-1/2 rounded" required>
                    <option value="">-- Pilih Bahan --</option>
                    @foreach ($materials as $m)
                        <option value="{{ $m->material_id }}">{{ $m->material_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="materials[${i}][quantity]" placeholder="Jumlah" class="border p-2 w-1/4 rounded" required>
                <input type="number" name="materials[${i}][price]" placeholder="Harga" class="border p-2 w-1/4 rounded" required>
            `;
            list.appendChild(div);
            i++;
        });
    </script>
@endsection
