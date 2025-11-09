@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">✏️ Edit Supplier</h1>

    <form action="{{ route('owner.suppliers.update', $supplier->supplier_id) }}" method="POST"
        class="bg-white p-6 rounded-xl shadow max-w-2xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Nama Supplier</label>
                <input name="supplier_name" value="{{ $supplier->supplier_name }}" class="border p-2 w-full rounded"
                    required>
            </div>
            <div>
                <label>Email</label>
                <input name="email" type="email" value="{{ $supplier->email }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Telepon</label>
                <input name="phone" value="{{ $supplier->phone }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Alamat</label>
                <input name="address" value="{{ $supplier->address }}" class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Kontak Person</label>
                <input name="contact_person" value="{{ $supplier->profile->contact_person ?? '' }}"
                    class="border p-2 w-full rounded">
            </div>
            <div>
                <label>Tipe Perusahaan</label>
                <input name="company_type" value="{{ $supplier->profile->company_type ?? '' }}"
                    class="border p-2 w-full rounded">
            </div>
            <div class="col-span-2">
                <label>Catatan</label>
                <textarea name="notes" rows="3"
                    class="border p-2 w-full rounded">{{ $supplier->profile->notes ?? '' }}</textarea>
            </div>
        </div>

        <button class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Update
        </button>
        <a href="{{ route('owner.suppliers.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
@endsection
