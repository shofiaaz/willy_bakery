@extends('owner.layouts.layout')

@section('content')
    <h1 class="text-3xl font-bold mb-6">📈 Dashboard Owner</h1>

    <div x-data="{ filter: '{{ request('filter_type', '7_days') }}' }" class="mb-6 bg-white p-4 rounded-xl shadow">
        <form action="{{ route('owner.dashboard.filter') }}" method="POST" class="flex flex-wrap items-center gap-4">
            @csrf
            <select name="filter_type" x-model="filter" class="border rounded p-2">
                <option value="7_days">7 Hari Terakhir</option>
                <option value="30_days">30 Hari Terakhir</option>
                <option value="custom">Custom Range</option>
            </select>

            <div x-show="filter === 'custom'" class="flex gap-2 items-center">
                <input type="date" name="start_date" value="{{ $startDate }}" class="border rounded p-2">
                <span>-</span>
                <input type="date" name="end_date" value="{{ $endDate }}" class="border rounded p-2">
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Tampilkan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Penjualan</h2>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Supplier</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalSuppliers }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <h2 class="text-xl font-semibold mb-2">Total Pembelian Bahan Baku</h2>
            <p class="text-3xl font-bold text-yellow-600">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Grafik Penjualan</h2>
            <canvas id="salesChart"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Grafik Pembelian</h2>
            <canvas id="purchaseChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        const salesCtx = document.getElementById('salesChart');
        const purchaseCtx = document.getElementById('purchaseChart');

        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesDates) !!},
                datasets: [{
                    label: 'Total Penjualan',
                    data: {!! json_encode($salesTotals) !!},
                    borderColor: 'rgb(34,197,94)',
                    backgroundColor: 'rgba(34,197,94,0.2)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });

        new Chart(purchaseCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($purchaseDates) !!},
                datasets: [{
                    label: 'Total Pembelian',
                    data: {!! json_encode($purchaseTotals) !!},
                    backgroundColor: 'rgba(234,179,8,0.7)',
                    borderColor: 'rgb(202,138,4)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
@endsection
