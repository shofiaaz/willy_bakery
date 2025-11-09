@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">📦 Manajemen Supplier</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('owner.suppliers.create') }}"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block mb-4">
        ➕ Tambah Supplier
    </a>

    <div class="bg-white rounded-xl shadow p-4">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border-b">Nama</th>
                    <th class="p-3 border-b">Email</th>
                    <th class="p-3 border-b">Telepon</th>
                    <th class="p-3 border-b">Kontak Person</th>
                    <th class="p-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $supplier->supplier_name }}</td>
                        <td class="p-3">{{ $supplier->email }}</td>
                        <td class="p-3">{{ $supplier->phone }}</td>
                        <td class="p-3">{{ $supplier->profile->contact_person ?? '-' }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('owner.suppliers.edit', $supplier->supplier_id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">Edit</a>
                            <form action="{{ route('owner.suppliers.destroy', $supplier->supplier_id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </div>
@endsection
