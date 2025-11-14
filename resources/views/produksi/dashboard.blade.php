@extends('produksi.layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-bread-800">Dashboard Produksi</h1>
    <p class="text-bread-600 mt-2">
        Selamat datang! Berikut ringkasan aktivitas & performa produksi hari ini.
    </p>
</div>

{{-- ============================
    FILTER PANEL (Same UI as Owner)
================================ --}}
<div x-data="{ filter: '{{ request('filter_type', '7_days') }}' }"
    class="mb-8 bg-white rounded-2xl card-shadow p-6">

    <h2 class="text-lg font-semibold text-bread-800 mb-4 flex items-center">
        <i class="fas fa-filter text-bread-500 mr-2"></i> Filter Laporan Produksi
    </h2>

    <form action="{{ route('produksi.dashboard.filter') }}" method="POST"
            class="flex flex-wrap items-center gap-4">
        @csrf

        <select name="filter_type" x-model="filter"
                class="border border-bread-200 rounded-xl p-3 bg-bread-50
                        focus:ring-2 focus:ring-bread-300">
            <option value="7_days">7 Hari Terakhir</option>
            <option value="30_days">30 Hari Terakhir</option>
            <option value="custom">Custom Range</option>
        </select>

        <div x-show="filter === 'custom'" class="flex gap-2 items-center">
            <input type="date" name="start_date" value="{{ $startDate }}"
                    class="border border-bread-200 rounded-xl p-3 bg-bread-50 focus:ring-2">
            <span class="text-bread-500">-</span>
            <input type="date" name="end_date" value="{{ $endDate }}"
                    class="border border-bread-200 rounded-xl p-3 bg-bread-50 focus:ring-2">
        </div>

        <button class="bg-bread-600 hover:bg-bread-700 text-white font-semibold px-5 py-3 rounded-xl">
            <i class="fas fa-chart-bar mr-2"></i> Tampilkan
        </button>
    </form>
</div>

{{-- ============================
    KPI CARDS
================================ --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Produksi --}}
    <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-bread-600 text-sm font-medium">Total Produksi Hari Ini</p>
                <h3 class="text-3xl font-bold text-bread-800 mt-2">
                    {{ $totalProductionBatches }} Batch
                </h3>
                <div class="flex items-center mt-3">
                    <span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-xs flex items-center">
                        <i class="fas fa-arrow-up mr-1 text-xs"></i> {{ $productionGrowth }}%
                    </span>
                    <span class="text-bread-500 text-sm ml-2">dari minggu lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <i class="fas fa-bread-slice text-green-600 text-xl"></i>
            </div>
        </div>
    </div>

    {{-- Bahan Baku Terpakai --}}
    <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-bread-600 text-sm font-medium">Bahan Baku Terpakai</p>
                <h3 class="text-3xl font-bold text-bread-800 mt-2">
                    {{ number_format($usedRawMaterials, 0, ',', '.') }} kg
                </h3>
                <div class="flex items-center mt-3">
                    <span class="bg-yellow-100 text-yellow-800 px-2.5 py-0.5 rounded-full text-xs">
                        <i class="fas fa-arrow-down mr-1"></i> {{ $materialUsageChange }}%
                    </span>
                    <span class="text-bread-500 text-sm ml-2">efisiensi bahan</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                <i class="fas fa-box-open text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>

    {{-- Stok Rendah --}}
    <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-bread-600 text-sm font-medium">Bahan Stok Rendah</p>
                <h3 class="text-3xl font-bold text-bread-800 mt-2">
                    {{ $lowStockCount }} Item
                </h3>
                <div class="flex items-center mt-3">
                    <span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-xs">
                        <i class="fas fa-exclamation mr-1"></i> Perlu Restock
                    </span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
            </div>
        </div>
    </div>

</div>

{{-- ============================
    CHARTS
================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    {{-- Grafik Produksi --}}
    <div class="bg-white rounded-2xl card-shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-bread-800 flex items-center">
                <i class="fas fa-chart-line text-bread-500 mr-2"></i> Grafik Volume Produksi
            </h2>
            <div class="text-sm text-bread-500">
                <i class="fas fa-circle text-green-500 mr-1 text-xs"></i> Produksi
            </div>
        </div>
        <canvas id="productionChart"></canvas>
    </div>

    {{-- Grafik Penggunaan Bahan --}}
    <div class="bg-white rounded-2xl card-shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-semibold text-bread-800 flex items-center">
                <i class="fas fa-chart-bar text-bread-500 mr-2"></i> Penggunaan Bahan Baku
            </h2>
            <div class="text-sm text-bread-500">
                <i class="fas fa-circle text-yellow-500 mr-1 text-xs"></i> Bahan
            </div>
        </div>
        <canvas id="materialsChart"></canvas>
    </div>

</div>

{{-- ============================
    QUICK ACTIONS
================================ --}}
<div class="bg-white rounded-2xl card-shadow p-6">
    <h2 class="text-lg font-semibold text-bread-800 mb-4 flex items-center">
        <i class="fas fa-toolbox text-bread-500 mr-2"></i> Akses Cepat
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <a href="{{ route('produksi.supplies.index') }}"
            class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50">
            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mb-2">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
            <span class="text-bread-700 font-medium text-sm">Kelola Bahan Baku</span>
        </a>

        <a href="{{ route('produksi.production.index') }}"
            class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50">
            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center mb-2">
                <i class="fas fa-industry text-purple-600 text-xl"></i>
            </div>
            <span class="text-bread-700 font-medium text-sm">Proses Produksi</span>
        </a>

        <a href="{{ route('produksi.product.index') }}"
            class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50">
            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mb-2">
                <i class="fas fa-bread-slice text-green-600 text-xl"></i>
            </div>
            <span class="text-bread-700 font-medium text-sm">Produk Jadi</span>
        </a>

        <a href="#"
            class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50">
            <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center mb-2">
                <i class="fas fa-clipboard-list text-orange-600 text-xl"></i>
            </div>
            <span class="text-bread-700 font-medium text-sm">Laporan Produksi</span>
        </a>

    </div>
</div>

{{-- ============================
    JS FOR CHARTS
================================ --}}
<script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
<script>
new Chart(document.getElementById('productionChart'), {
    type: 'line',
    data: {
        labels: @json($productionDates),
        datasets: [{
            label: 'Produksi',
            data: @json($productionTotals),
            borderColor: 'rgb(34,197,94)',
            backgroundColor: 'rgba(34,197,94,0.1)',
            fill: true,
            tension: 0.4,
            borderWidth: 3,
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});

new Chart(document.getElementById('materialsChart'), {
    type: 'bar',
    data: {
        labels: @json($materialDates),
        datasets: [{
            label: 'Bahan Terpakai',
            data: @json($materialTotals),
            backgroundColor: 'rgba(234,179,8,0.7)'
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>
@endsection
