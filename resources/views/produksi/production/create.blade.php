@extends('produksi.layouts.app')

@section('content')

<h1 class="text-3xl font-bold text-bread-800 mb-6">Tambah Produksi Baru</h1>

<div class="bg-white p-6 rounded-xl card-shadow max-w-3xl">

    <form action="{{ route('produksi.production.store') }}" method="POST">
        @csrf

        {{-- Select Product --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Pilih Produk</label>
            <select name="product_id" id="productSelect"
                class="w-full mt-1 p-2 border rounded-lg" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $prod)
                <option value="{{ $prod->product_id }}">{{ $prod->product_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Production Date --}}
        <div class="mb-4">
            <label class="font-semibold text-bread-700">Tanggal Produksi</label>
            <input type="date" name="production_date" required
                class="w-full mt-1 p-2 border rounded-lg"
                value="{{ date('Y-m-d') }}">
        </div>

        {{-- Quantity --}}
        <div class="mb-6">
            <label class="font-semibold text-bread-700">Jumlah Diproduksi</label>
            <input type="number" id="qtyInput" name="quantity_produced" min="1" required
                class="w-full mt-1 p-2 border rounded-lg" placeholder="Masukkan jumlah">
        </div>

        {{-- Recipe Needs --}}
        <div id="recipeContainer" class="hidden mb-6">
            <h2 class="text-xl font-bold text-bread-800 mb-3">Kebutuhan Bahan</h2>

            <table class="w-full text-left border rounded-lg overflow-hidden">
                <thead class="bg-bread-100">
                    <tr>
                        <th class="py-2 px-3">Bahan</th>
                        <th class="py-2 px-3">Stok</th>
                        <th class="py-2 px-3">Butuh / Unit</th>
                        <th class="py-2 px-3">Total Dibutuhkan</th>
                    </tr>
                </thead>
                <tbody id="recipeTable"></tbody>
            </table>

            <p id="stockWarning" class="mt-3 text-red-600 font-semibold hidden">
                ⚠️ Stok tidak cukup untuk produksi ini!
            </p>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end space-x-3 mt-6">
            <a href="{{ route('produksi.production.index') }}"
                class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>

            <button id="submitBtn"
                class="px-4 py-2 bg-bread-600 text-white rounded-lg hover:bg-bread-700">
                Simpan Produksi
            </button>
        </div>

    </form>

</div>

{{-- JS --}}
@push('scripts')
<script>
    let recipes = @json($recipes); // All recipes grouped by product

    const productSelect = document.getElementById('productSelect');
    const qtyInput       = document.getElementById('qtyInput');
    const recipeContainer= document.getElementById('recipeContainer');
    const recipeTable    = document.getElementById('recipeTable');
    const stockWarning   = document.getElementById('stockWarning');
    const submitBtn      = document.getElementById('submitBtn');

    productSelect.addEventListener('change', updateRecipeTable);
    qtyInput.addEventListener('input', updateRecipeTable);

    function updateRecipeTable() {
        let productId = productSelect.value;
        let qty       = parseInt(qtyInput.value) || 0;

        if (!productId || qty < 1) {
            recipeContainer.classList.add('hidden');
            return;
        }

        let items = recipes[productId] || [];
        recipeTable.innerHTML = '';
        let stockOK = true;

        items.forEach(item => {
            let totalNeed = item.quantity_needed * qty;

            if (totalNeed > item.material.stock) {
                stockOK = false;
            }

            recipeTable.innerHTML += `
                <tr class="border-b">
                    <td class="py-2 px-3">${item.material.material_name}</td>
                    <td class="py-2 px-3">${item.material.stock}</td>
                    <td class="py-2 px-3">${item.quantity_needed}</td>
                    <td class="py-2 px-3 font-semibold ${totalNeed > item.material.stock ? 'text-red-600' : 'text-bread-800'}">
                        ${totalNeed}
                    </td>
                </tr>
            `;
        });

        recipeContainer.classList.remove('hidden');

        if (stockOK) {
            stockWarning.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50');
        } else {
            stockWarning.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50');
        }
    }

</script>
@endpush

@endsection
