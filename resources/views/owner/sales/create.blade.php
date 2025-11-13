@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2">Tambah Transaksi Penjualan</h1>
            <p class="text-bread-600">Tambah transaksi penjualan baru untuk pelanggan</p>
        </div>
        <form action="{{ route('owner.sales.store') }}" method="POST" class="max-w-4xl">
            @csrf
            <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-bread-600 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-bread-800">Informasi Pelanggan</h3>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-bread-700 mb-2">
                        <i class="fas fa-users mr-1 text-bread-500"></i>
                        Pilih Pelanggan Lama
                    </label>
                    <select name="customer_id"
                        class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white"
                        id="customerSelect">
                        <option value="">-- Pilih pelanggan yang sudah terdaftar --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }} ({{ $customer->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-bread-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-bread-500">Atau</span>
                    </div>
                </div>
                <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                    <h4 class="text-md font-semibold text-bread-700 mb-4 flex items-center">
                        <i class="fas fa-user-plus mr-2 text-bread-600"></i>
                        Tambah Pelanggan Baru
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">Nama Pelanggan</label>
                            <input type="text" name="new_customer_name"
                                class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">Email <span
                                    class="text-bread-400 text-xs">(opsional)</span></label>
                            <input type="email" name="new_customer_email"
                                class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                placeholder="email@contoh.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">Nomor Telepon</label>
                            <input type="text" name="new_customer_phone"
                                class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-bread-700 mb-2">Alamat</label>
                            <textarea name="new_customer_address" rows="3"
                                class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                placeholder="Alamat lengkap pelanggan"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-bread-slice text-bread-600 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-bread-800">Informasi Produk</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-bread-700 mb-2">
                            <i class="fas fa-box mr-1 text-bread-500"></i>
                            Pilih Produk
                        </label>
                        <select name="product_id"
                            class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white"
                            required>
                            <option value="">-- Pilih produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_id }}" data-stock="{{ $product->stock }}"
                                    data-price="{{ $product->price }}">
                                    {{ $product->product_name }}
                                    <span class="text-bread-500 text-sm">(stok: {{ $product->stock }})</span>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-bread-700 mb-2">
                            <i class="fas fa-hashtag mr-1 text-bread-500"></i>
                            Jumlah
                        </label>
                        <div class="relative">
                            <input type="number" name="quantity" id="quantityInput"
                                class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                min="1" required placeholder="0">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-bread-400 text-sm">pcs</span>
                            </div>
                        </div>
                        <div id="stockWarning" class="hidden mt-2 text-xs text-red-600 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <span>Jumlah melebihi stok tersedia</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-bread-700 mb-2">
                            <i class="fas fa-tag mr-1 text-bread-500"></i>
                            Harga per Unit
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-bread-500">Rp</span>
                            <input type="number" name="price" id="priceInput"
                                class="w-full pl-10 pr-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                min="0" required placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-bread-25 rounded-lg border border-bread-200">
                    <div class="flex justify-between items-center">
                        <span class="text-bread-700 font-medium">Total Pembayaran:</span>
                        <span id="totalAmount" class="text-2xl font-bold text-bread-800">Rp 0</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('owner.sales.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-bread-300 text-bread-700 bg-white hover:bg-bread-50 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-bread-600 hover:bg-bread-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSelect = document.querySelector('select[name="product_id"]');
            const quantityInput = document.getElementById('quantityInput');
            const priceInput = document.getElementById('priceInput');
            const totalAmount = document.getElementById('totalAmount');
            const stockWarning = document.getElementById('stockWarning');

            let selectedProduct = null;

            productSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    selectedProduct = {
                        stock: parseInt(selectedOption.dataset.stock),
                        price: parseInt(selectedOption.dataset.price)
                    };
                    priceInput.value = selectedProduct.price;
                    updateTotal();
                    checkStock();
                } else {
                    selectedProduct = null;
                    priceInput.value = '';
                    updateTotal();
                    stockWarning.classList.add('hidden');
                }
            });

            quantityInput.addEventListener('input', function () {
                updateTotal();
                checkStock();
            });

            priceInput.addEventListener('input', function () {
                updateTotal();
            });

            function updateTotal() {
                const quantity = parseInt(quantityInput.value) || 0;
                const price = parseInt(priceInput.value) || 0;
                const total = quantity * price;

                totalAmount.textContent = 'Rp ' + total.toLocaleString('id-ID');
            }

            function checkStock() {
                if (!selectedProduct) return;

                const quantity = parseInt(quantityInput.value) || 0;
                if (quantity > selectedProduct.stock) {
                    stockWarning.classList.remove('hidden');
                    quantityInput.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                    quantityInput.classList.remove('border-bread-200', 'focus:ring-bread-500', 'focus:border-bread-500');
                } else {
                    stockWarning.classList.add('hidden');
                    quantityInput.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                    quantityInput.classList.add('border-bread-200', 'focus:ring-bread-500', 'focus:border-bread-500');
                }
            }

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

        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
@endsection
