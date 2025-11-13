@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                        <i class="fas fa-truck text-bread-600"></i>
                    </div>
                    Manajemen Supplier
                </h1>
                <p class="text-bread-600">Kelola data supplier dan pemasok bahan baku</p>
            </div>
            <a href="{{ route('owner.suppliers.create') }}"
                class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white font-medium rounded-lg transition-colors duration-200">
                <i class="fas fa-plus-circle mr-2"></i>
                Tambah Supplier Baru
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
                        <i class="fas fa-truck text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Total Supplier</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $suppliers->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Supplier Aktif</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $suppliers->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-phone text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Kontak Tersedia</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $suppliers->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-sm border border-bread-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-lg bg-purple-50 text-purple-600 mr-4">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div>
                        <p class="text-bread-500 text-sm">Email Terdaftar</p>
                        <p class="text-2xl font-bold text-bread-800">{{ $suppliers->where('email', '!=', null)->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-bread-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-bread-100 bg-bread-50">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h3 class="text-lg font-semibold text-bread-800">Daftar Supplier</h3>
                    <div class="mt-2 md:mt-0">
                        <div class="relative">
                            <input type="text" placeholder="Cari supplier..."
                                class="pl-10 pr-4 py-2 border border-bread-200 rounded-lg focus:ring-2 focus:ring-bread-500 focus:border-bread-500 text-sm">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-bread-400"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-bread-50 text-bread-700 text-sm">
                            <th class="py-4 px-6 text-left font-medium">Supplier</th>
                            <th class="py-4 px-6 text-left font-medium">Kontak</th>
                            <th class="py-4 px-6 text-left font-medium">Kontak Person</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-bread-100">
                        @forelse($suppliers as $supplier)
                            <tr class="hover:bg-bread-25 transition-colors duration-150">
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-bread-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-truck text-bread-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-bread-800">{{ $supplier->supplier_name }}</div>
                                            <div class="text-sm text-bread-500">{{ $supplier->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="space-y-1">
                                        @if($supplier->phone)
                                            <div class="flex items-center text-sm text-bread-700">
                                                <i class="fas fa-phone mr-2 text-bread-400 text-xs"></i>
                                                {{ $supplier->phone }}
                                            </div>
                                        @endif
                                        @if($supplier->email)
                                            <div class="flex items-center text-sm text-bread-700">
                                                <i class="fas fa-envelope mr-2 text-bread-400 text-xs"></i>
                                                {{ $supplier->email }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-bread-700">
                                    @if($supplier->profile && $supplier->profile->contact_person)
                                        <div class="flex items-center">
                                            <i class="fas fa-user mr-2 text-bread-400"></i>
                                            {{ $supplier->profile->contact_person }}
                                        </div>
                                    @else
                                        <span class="text-bread-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-circle mr-1 text-xs"></i>
                                        Aktif
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('owner.suppliers.edit', $supplier->supplier_id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg text-sm font-medium transition-colors duration-200"
                                            title="Edit Supplier">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('owner.suppliers.destroy', $supplier->supplier_id) }}"
                                            method="POST" class="delete-form inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors duration-200"
                                                data-supplier="{{ $supplier->supplier_name }}">
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
                                        <i class="fas fa-truck text-4xl mb-4 text-bread-300"></i>
                                        <p class="text-lg font-medium mb-2">Belum ada supplier</p>
                                        <p class="text-sm mb-4">Mulai tambahkan supplier pertama Anda</p>
                                        <a href="{{ route('owner.suppliers.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-bread-600 hover:bg-bread-700 text-white rounded-lg transition-colors duration-200">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Tambah Supplier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($suppliers->hasPages())
                <div class="px-6 py-4 border-t border-bread-100 bg-bread-25">
                    {{ $suppliers->links('vendor.pagination.tailwind') }}
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const deleteButtons = document.querySelectorAll('.delete-btn');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const supplierName = this.dataset.supplier;
                        const form = this.closest('form');

                        Swal.fire({
                            title: 'Hapus Supplier?',
                            text: `Apakah Anda yakin ingin menghapus supplier "${supplierName}"?`,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal',
                            background: '#fffdf9',
                            color: '#5a4a3b',
                            customClass: {
                                popup: 'rounded-2xl shadow-lg border border-bread-100',
                                confirmButton: 'rounded-lg px-4 py-2 font-medium',
                                cancelButton: 'rounded-lg px-4 py-2 font-medium'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
