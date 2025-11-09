@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">➕ Tambah Supplier Baru</h1>

    <form action="{{ route('owner.suppliers.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow max-w-2xl">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Nama Supplier</label>
                <input name="supplier_name" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label>Email</label>
                <input name="email" type="email" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Telepon</label>
                <input name="phone" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Alamat</label>
                <input name="address" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Kontak Person</label>
                <input name="contact_person" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Tipe Perusahaan</label>
                <input name="company_type" class="border p-2 w-full rounded">
            </div>
            <div class="col-span-2">
                <label>Catatan</label>
                <textarea name="notes" rows="3" class="border p-2 w-full rounded"></textarea>
            </div>
        </div>

        <button class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
        <a href="{{ route('owner.suppliers.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
@endsection
