@extends('produksi.layouts.app')

@section('content')

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-bread-800">Manajemen Bahan Baku</h1>
    <a href="{{ route('produksi.supplies.create') }}"
        class="bg-bread-500 hover:bg-bread-600 text-white px-4 py-2 rounded-lg shadow hover-lift">
        <i class="fa fa-plus mr-2"></i>Tambah Bahan Baku
    </a>
</div>

<div class="bg-white p-6 rounded-xl card-shadow">
    <table class="min-w-full text-left">
        <thead>
            <tr class="border-b text-bread-700">
                <th class="py-3">Nama Bahan</th>
                <th class="py-3">Stok</th>
                <th class="py-3">Satuan</th>
                <th class="py-3">Biaya/Unit</th>
                <th class="py-3 w-32 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplies as $s)
            <tr class="border-b hover:bg-bread-50">
                <td class="py-3">{{ $s->material_name }}</td>
                <td class="py-3">{{ $s->stock }}</td>
                <td class="py-3">{{ $s->unit }}</td>
                <td class="py-3">Rp {{ number_format($s->cost_per_unit, 0, ',', '.') }}</td>
                <td class="py-3 text-center">
                    <a href="{{ route('produksi.supplies.edit', $s->material_id) }}"
                        class="text-blue-600 hover:underline">Edit</a>

                    <form action="{{ route('produksi.supplies.destroy', $s->material_id) }}" method="POST"
                        class="inline-block"
                        onsubmit="return confirm('Yakin ingin menghapus bahan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection