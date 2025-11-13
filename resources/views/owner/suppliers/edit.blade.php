@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-8">
            <div class="flex items-center mb-3">
                <h1 class="text-2xl md:text-3xl font-bold text-bread-800 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-edit text-bread-600"></i>
                    </div>
                    Edit Supplier
                </h1>
            </div>
            <p class="text-bread-600 ml-14">Update data supplier {{ $supplier->supplier_name }}</p>
        </div>
        <form action="{{ route('owner.suppliers.update', $supplier->supplier_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle text-bread-600 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-bread-800">Informasi Dasar</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                <span class="text-red-500">*</span> Nama Supplier
                            </label>
                            <div class="relative">
                                <input type="text" name="supplier_name"
                                    value="{{ old('supplier_name', $supplier->supplier_name) }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    placeholder="Masukkan nama supplier" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-truck text-bread-400"></i>
                                </div>
                            </div>
                            @error('supplier_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Kontak Person
                            </label>
                            <div class="relative">
                                <input type="text" name="contact_person"
                                    value="{{ old('contact_person', $supplier->profile->contact_person ?? '') }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    placeholder="Nama kontak person">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-user text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                            <i class="fas fa-address-book text-bread-600 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-bread-800">Informasi Kontak</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email', $supplier->email) }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    placeholder="email@supplier.com">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-envelope text-bread-400"></i>
                                </div>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Telepon
                            </label>
                            <div class="relative">
                                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    placeholder="08xxxxxxxxxx">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-phone text-bread-400"></i>
                                </div>
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6 mb-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                            <i class="fas fa-building text-bread-600 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-bread-800">Informasi Perusahaan</h3>
                    </div>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Alamat
                            </label>
                            <div class="relative">
                                <input type="text" name="address" value="{{ old('address', $supplier->address) }}"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200"
                                    placeholder="Alamat lengkap perusahaan">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <i class="fas fa-map-marker-alt text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Tipe Perusahaan
                            </label>
                            <div class="relative">
                                <select name="company_type"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 bg-white appearance-none">
                                    <option value="">Pilih tipe perusahaan</option>
                                    <option value="PT" {{ old('company_type', $supplier->profile->company_type ?? '') == 'PT' ? 'selected' : '' }}>PT (Perseroan Terbatas)</option>
                                    <option value="CV" {{ old('company_type', $supplier->profile->company_type ?? '') == 'CV' ? 'selected' : '' }}>CV (Commanditaire Vennootschap)</option>
                                    <option value="UD" {{ old('company_type', $supplier->profile->company_type ?? '') == 'UD' ? 'selected' : '' }}>UD (Usaha Dagang)</option>
                                    <option value="Firma" {{ old('company_type', $supplier->profile->company_type ?? '') == 'Firma' ? 'selected' : '' }}>Firma</option>
                                    <option value="Perorangan" {{ old('company_type', $supplier->profile->company_type ?? '') == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                                    <option value="Lainnya" {{ old('company_type', $supplier->profile->company_type ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-bread-700 mb-2">
                                Catatan
                            </label>
                            <div class="relative">
                                <textarea name="notes" rows="4"
                                    class="w-full px-4 py-3 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 transition-colors duration-200 resize-none"
                                    placeholder="Catatan tambahan tentang supplier">{{ old('notes', $supplier->profile->notes ?? '') }}</textarea>
                                <div class="absolute top-3 right-3">
                                    <i class="fas fa-sticky-note text-bread-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-bread-25 rounded-xl p-6 border border-bread-100 mb-6">
                    <h3 class="text-lg font-semibold text-bread-800 mb-4 flex items-center">
                        <i class="fas fa-chart-bar mr-2 text-bread-600"></i>
                        Statistik Supplier
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="bg-white rounded-lg p-4 border border-bread-200">
                            <div class="text-2xl font-bold text-bread-700">0</div>
                            <div class="text-sm text-bread-500">Total Pembelian</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-bread-200">
                            <div class="text-2xl font-bold text-bread-700">Rp 0</div>
                            <div class="text-sm text-bread-500">Total Nilai</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-bread-200">
                            <div class="text-2xl font-bold text-bread-700">-</div>
                            <div class="text-sm text-bread-500">Pembelian Terakhir</div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 justify-end bg-bread-25 rounded-xl p-6 border border-bread-100">
                    <a href="{{ route('owner.suppliers.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-bread-300 text-bread-700 bg-white hover:bg-bread-50 rounded-lg font-medium transition-colors duration-200 order-2 sm:order-1">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-6 py-3 bg-bread-600 hover:bg-bread-700 text-white rounded-lg font-medium transition-colors duration-200 order-1 sm:order-2">
                        <i class="fas fa-save mr-2"></i>
                        Update Supplier
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const requiredFields = document.querySelectorAll('input[required]');

            requiredFields.forEach(field => {
                field.addEventListener('blur', function () {
                    if (!this.value) {
                        this.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                        this.classList.remove('border-bread-200', 'focus:ring-bread-500', 'focus:border-bread-500');
                    } else {
                        this.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
                        this.classList.add('border-bread-200', 'focus:ring-bread-500', 'focus:border-bread-500');
                    }
                });
            });

            const phoneInput = document.querySelector('input[name="phone"]');
            phoneInput.addEventListener('input', function (e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.startsWith('0')) {
                    value = value.substring(0, 12);
                } else if (value.startsWith('62')) {
                    value = value.substring(0, 15);
                }

                e.target.value = value;
            });

            let formChanged = false;
            const form = document.querySelector('form');
            const initialFormData = new FormData(form);

            form.addEventListener('input', function () {
                formChanged = true;
            });

            window.addEventListener('beforeunload', function (e) {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            form.addEventListener('submit', function () {
                formChanged = false;
            });
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

        @media (max-width: 768px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
