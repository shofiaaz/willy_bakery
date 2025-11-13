@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-8">
            <div class="flex items-center mb-3">
                <h1 class="text-2xl md:text-3xl font-bold text-bread-800 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-plus text-bread-600"></i>
                    </div>
                    Buat Pesanan Pembelian Bahan Baku
                </h1>
            </div>
            <p class="text-bread-600 ml-14">Buat pesanan pembelian bahan baku baru dari supplier</p>
        </div>

        <form action="{{ route('owner.purchases.store') }}" method="POST">
            @csrf

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-bread-600 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-bread-800">Informasi Pesanan</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Pilih Supplier
                            </label>
                            <div class="relative">
                                <select name="supplier_id"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white appearance-none"
                                    required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Tanggal Pemesanan
                            </label>
                            <div class="relative">
                                <input type="date" name="order_date" value="{{ now()->toDateString() }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-calendar-alt text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                                <i class="fas fa-boxes text-bread-600 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-bread-800">Daftar Bahan Baku</h3>
                        </div>
                        <button type="button" id="addMaterial"
                            class="inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Bahan
                        </button>
                    </div>
                    <div id="material-list">
                        <div class="material-row bg-bread-25 rounded-lg p-4 mb-4 border border-bread-200">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                                <div class="md:col-span-5">
                                    <label class="block text-sm font-medium text-bread-700 mb-2">
                                        <span class="text-red-500">*</span> Bahan Baku
                                    </label>
                                    <div class="relative">
                                        <select name="materials[0][material_id]"
                                            class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white appearance-none material-select"
                                            required>
                                            <option value="">-- Pilih Bahan Baku --</option>
                                            @foreach ($materials as $m)
                                                <option value="{{ $m->material_id }}" data-price="{{ $m->price }}">
                                                    {{ $m->material_name }}
                                                    <span class="text-bread-500 text-sm">(Rp
                                                        {{ number_format($m->price, 0, ',', '.') }})</span>
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-bread-400"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-bread-700 mb-2">
                                        <span class="text-red-500">*</span> Jumlah
                                    </label>
                                    <div class="relative">
                                        <input type="number" name="materials[0][quantity]"
                                            class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 quantity-input"
                                            placeholder="0" min="1" required>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-bread-400 text-sm">unit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-bread-700 mb-2">
                                        <span class="text-red-500">*</span> Harga Satuan
                                    </label>
                                    <div class="relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-bread-500">Rp</span>
                                        <input type="number" name="materials[0][price]"
                                            class="w-full pl-10 pr-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 price-input"
                                            placeholder="0" min="0" required>
                                    </div>
                                </div>
                                <div class="md:col-span-1 flex justify-center">
                                    <button type="button"
                                        class="remove-material text-red-500 hover:text-red-700 p-2 opacity-0 cursor-default">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-bread-200">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-bread-600">Subtotal:</span>
                                    <span class="font-semibold text-bread-800 subtotal-display">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 p-4 bg-bread-50 rounded-lg border border-bread-200">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-bread-800">Total Pesanan:</span>
                            <span id="totalAmount" class="text-2xl font-bold text-bread-800">Rp 0</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 justify-end bg-bread-25 rounded-xl p-6 border border-bread-100">
                    <a href="{{ route('owner.purchases.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-bread-300 text-bread-700 bg-white hover:bg-bread-50 rounded-lg font-medium transition-colors duration-200 order-2 sm:order-1">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-bread-600 hover:bg-bread-700 text-white rounded-lg font-medium transition-colors duration-200 order-1 sm:order-2">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let materialCount = 1;
            const materialList = document.getElementById('material-list');
            const addMaterialBtn = document.getElementById('addMaterial');

            addMaterialBtn.addEventListener('click', function () {
                const newRow = document.createElement('div');
                newRow.className = 'material-row bg-bread-25 rounded-lg p-4 mb-4 border border-bread-200';
                newRow.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Bahan Baku
                            </label>
                            <div class="relative">
                                <select name="materials[${materialCount}][material_id]"
                                        class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white appearance-none material-select"
                                        required>
                                    <option value="">-- Pilih Bahan Baku --</option>
                                    @foreach ($materials as $m)
                                        <option value="{{ $m->material_id }}" data-price="{{ $m->price }}">
                                            {{ $m->material_name }}
                                            <span class="text-bread-500 text-sm">(Rp {{ number_format($m->price, 0, ',', '.') }})</span>
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-bread-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Jumlah
                            </label>
                            <div class="relative">
                                <input type="number" name="materials[${materialCount}][quantity]"
                                       class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 quantity-input"
                                       placeholder="0"
                                       min="1"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span class="text-bread-400 text-sm">unit</span>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Harga Satuan
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-bread-500">Rp</span>
                                <input type="number" name="materials[${materialCount}][price]"
                                       class="w-full pl-10 pr-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 price-input"
                                       placeholder="0"
                                       min="0"
                                       required>
                            </div>
                        </div>

                        <div class="md:col-span-1 flex justify-center">
                            <button type="button" class="remove-material text-red-500 hover:text-red-700 p-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mt-3 pt-3 border-t border-bread-200">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-bread-600">Subtotal:</span>
                            <span class="font-semibold text-bread-800 subtotal-display">Rp 0</span>
                        </div>
                    </div>
                `;

                materialList.appendChild(newRow);
                materialCount++;
                initializeMaterialRow(newRow);
                updateTotal();
            });
            function initializeMaterialRow(row) {
                const materialSelect = row.querySelector('.material-select');
                const quantityInput = row.querySelector('.quantity-input');
                const priceInput = row.querySelector('.price-input');
                const subtotalDisplay = row.querySelector('.subtotal-display');
                const removeBtn = row.querySelector('.remove-material');
                materialSelect.addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption.value && selectedOption.dataset.price) {
                        priceInput.value = selectedOption.dataset.price;
                        updateSubtotal();
                        updateTotal();
                    }
                });
                quantityInput.addEventListener('input', updateSubtotal);
                priceInput.addEventListener('input', updateSubtotal);

                removeBtn.addEventListener('click', function () {
                    if (document.querySelectorAll('.material-row').length > 1) {
                        row.remove();
                        updateTotal();
                    }
                });

                function updateSubtotal() {
                    const quantity = parseInt(quantityInput.value) || 0;
                    const price = parseInt(priceInput.value) || 0;
                    const subtotal = quantity * price;

                    subtotalDisplay.textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
                    updateTotal();
                }
            }
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.material-row').forEach(row => {
                    const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
                    const price = parseInt(row.querySelector('.price-input').value) || 0;
                    total += quantity * price;
                });

                document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
            }
            document.querySelectorAll('.material-row').forEach(row => {
                initializeMaterialRow(row);
            });

            document.addEventListener('mouseover', function (e) {
                if (e.target.closest('.material-row')) {
                    const row = e.target.closest('.material-row');
                    const removeBtn = row.querySelector('.remove-material');
                    const allRows = document.querySelectorAll('.material-row');

                    if (allRows.length > 1) {
                        removeBtn.classList.remove('opacity-0', 'cursor-default');
                    }
                }
            });

            document.addEventListener('mouseout', function (e) {
                if (e.target.closest('.material-row')) {
                    const row = e.target.closest('.material-row');
                    const removeBtn = row.querySelector('.remove-material');
                    removeBtn.classList.add('opacity-0', 'cursor-default');
                }
            });
            updateTotal();
        });
    </script>

    <style>
        .bg-bread-25 {
            background-color: rgba(251, 245, 239, 0.5);
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(199, 122, 61, 0.1);
        }

        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .material-row {
            transition: all 0.3s ease;
        }

        .material-row:hover {
            border-color: var(--bread-300);
        }

        .remove-material {
            transition: all 0.2s ease;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .grid-cols-12>div {
                grid-column: span 12 / span 12;
            }

            .remove-material {
                opacity: 1 !important;
                cursor: pointer !important;
            }
        }
    </style>
@endsection
