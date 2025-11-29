@extends('owner.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-bread-800 mb-2">📊 Laporan & Forecasting</h1>
                    <p class="text-bread-600">Analisis dan prediksi performa bisnis Willy Bakery</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center space-x-2 text-sm text-bread-500">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Periode: {{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="border-b border-gray-200">
                <nav class="flex overflow-x-auto -mb-px">
                    <button class="tab-button active whitespace-nowrap" data-tab="stok">
                        <i class="fas fa-boxes mr-2"></i>
                        Stok Produk & Bahan
                    </button>
                    <button class="tab-button whitespace-nowrap" data-tab="penjualan">
                        <i class="fas fa-chart-line mr-2"></i>
                        Penjualan
                    </button>
                    <button class="tab-button whitespace-nowrap" data-tab="pembelian">
                        <i class="fas fa-shopping-basket mr-2"></i>
                        Pembelian
                    </button>
                    <button class="tab-button whitespace-nowrap" data-tab="forecast">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Forecasting
                    </button>

                </nav>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="stok-tab">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                                <i class="fas fa-boxes text-bread-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-bread-800">Laporan Stok Produk dan Bahan</h3>
                                <p class="text-bread-500 text-sm">Ringkasan stok terkini dan bahan baku</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('owner.reports.pdf', 'stock') }}"
                                class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-pdf mr-2"></i>
                                PDF
                            </a>
                            <a href="{{ route('owner.reports.excel', 'stock') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-excel mr-2"></i>
                                Excel
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-bread-100 text-bread-600 mr-3">
                                    <i class="fas fa-bread-slice"></i>
                                </div>
                                <div>
                                    <p class="text-bread-500 text-sm">Total Produk</p>
                                    <p class="text-xl font-bold text-bread-800">{{ $products->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-bread-100 text-bread-600 mr-3">
                                    <i class="fas fa-flask"></i>
                                </div>
                                <div>
                                    <p class="text-bread-500 text-sm">Total Bahan Baku</p>
                                    <p class="text-xl font-bold text-bread-800">{{ $materials->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                            <div class="flex items-center">
                                <div class="p-2 rounded-lg bg-bread-100 text-bread-600 mr-3">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div>
                                    <p class="text-bread-500 text-sm">Total Item</p>
                                    <p class="text-xl font-bold text-bread-800">
                                        {{ $products->count() + $materials->count() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-bread-50 text-bread-700 text-sm">
                                    <th class="py-3 px-4 text-left font-medium">Nama Item</th>
                                    <th class="py-3 px-4 text-left font-medium">Jenis</th>
                                    <th class="py-3 px-4 text-left font-medium">Stok</th>
                                    <th class="py-3 px-4 text-left font-medium">Satuan/Harga</th>
                                    <th class="py-3 px-4 text-left font-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-bread-100">
                                @foreach($products as $p)
                                    <tr class="hover:bg-bread-25 transition-colors duration-150">
                                        <td class="py-3 px-4 text-bread-800 font-medium">
                                            <div class="flex items-center">
                                                <i class="fas fa-bread-slice mr-2 text-bread-400"></i>
                                                {{ $p->product_name }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Produk Jadi
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            <span class="font-semibold">{{ $p->stock }}</span> pcs
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            Rp {{ number_format($p->price, 0, ',', '.') }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($p->stock > 20)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Aman
                                                </span>
                                            @elseif($p->stock > 5)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-exclamation mr-1"></i>
                                                    Menipis
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Habis
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($materials as $m)
                                    <tr class="hover:bg-bread-25 transition-colors duration-150">
                                        <td class="py-3 px-4 text-bread-800 font-medium">
                                            <div class="flex items-center">
                                                <i class="fas fa-flask mr-2 text-bread-400"></i>
                                                {{ $m->material_name }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                Bahan Baku
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            <span class="font-semibold">{{ $m->stock }}</span> {{ $m->unit }}
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            Rp {{ number_format($m->cost_per_unit, 0, ',', '.') }}/{{ $m->unit }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($m->stock > 50)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Aman
                                                </span>
                                            @elseif($m->stock > 10)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-exclamation mr-1"></i>
                                                    Menipis
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Habis
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane hidden" id="penjualan-tab">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                                <i class="fas fa-chart-line text-bread-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-bread-800">Laporan Penjualan</h3>
                                <p class="text-bread-500 text-sm">Analisis performa penjualan mingguan/bulanan</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('owner.reports.pdf', 'sales') }}"
                                class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-pdf mr-2"></i>
                                PDF
                            </a>
                            <a href="{{ route('owner.reports.excel', 'sales') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-excel mr-2"></i>
                                Excel
                            </a>
                        </div>
                    </div>
                    <div class="bg-bread-25 rounded-lg p-4 mb-6 border border-bread-200">
                        <h4 class="text-lg font-semibold text-bread-800 mb-4">Grafik Penjualan</h4>
                        <canvas id="salesChart" height="120"></canvas>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-bread-50 text-bread-700 text-sm">
                                    <th class="py-3 px-4 text-left font-medium">Tanggal</th>
                                    <th class="py-3 px-4 text-left font-medium">Produk</th>
                                    <th class="py-3 px-4 text-left font-medium">Pelanggan</th>
                                    <th class="py-3 px-4 text-left font-medium">Jumlah</th>
                                    <th class="py-3 px-4 text-left font-medium">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-bread-100">
                                @foreach($sales as $s)
                                    <tr class="hover:bg-bread-25 transition-colors duration-150">
                                        <td class="py-3 px-4 text-bread-700">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-day mr-2 text-bread-400"></i>
                                                {{ \Carbon\Carbon::parse($s->sale_date)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-bread-800 font-medium">
                                            {{ $s->product->product_name ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            {{ $s->customer->customer_name ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4 text-bread-700">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-bread-100 text-bread-800">
                                                {{ $s->quantity }} pcs
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="font-semibold text-bread-800">
                                                Rp {{ number_format($s->total, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane hidden" id="pembelian-tab">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                                <i class="fas fa-shopping-basket text-bread-600"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-bread-800">Laporan Pembelian</h3>
                                <p class="text-bread-500 text-sm">Pengeluaran dan pembelian bahan baku</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('owner.reports.pdf', 'purchase') }}"
                                class="inline-flex items-center px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-pdf mr-2"></i>
                                PDF
                            </a>
                            <a href="{{ route('owner.reports.excel', 'purchase') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-50 hover:bg-green-100 text-green-600 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-file-excel mr-2"></i>
                                Excel
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-bread-500 text-sm">Total Pembelian</p>
                                    <p class="text-2xl font-bold text-bread-800">{{ $purchases->count() }}</p>
                                </div>
                                <div class="p-2 rounded-lg bg-bread-100 text-bread-600">
                                    <i class="fas fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-bread-500 text-sm">Total Pengeluaran</p>
                                    <p class="text-2xl font-bold text-bread-800">
                                        Rp {{ number_format($purchases->sum('total_price'), 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-2 rounded-lg bg-bread-100 text-bread-600">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-bread-50 text-bread-700 text-sm">
                                    <th class="py-3 px-4 text-left font-medium">Tanggal</th>
                                    <th class="py-3 px-4 text-left font-medium">Supplier</th>
                                    <th class="py-3 px-4 text-left font-medium">Status</th>
                                    <th class="py-3 px-4 text-left font-medium">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-bread-100">
                                @foreach($purchases as $po)
                                    <tr class="hover:bg-bread-25 transition-colors duration-150">
                                        <td class="py-3 px-4 text-bread-700">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-day mr-2 text-bread-400"></i>
                                                {{ \Carbon\Carbon::parse($po->order_date)->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-bread-800 font-medium">
                                            {{ $po->supplier->supplier_name ?? '-' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if($po->status == 'completed')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i>
                                                    Selesai
                                                </span>
                                            @elseif($po->status == 'pending')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-clock mr-1"></i>
                                                    Pending
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="font-semibold text-bread-800">
                                                Rp {{ number_format($po->total_price, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane hidden" id="forecast-tab">
                <div class="bg-white rounded-xl shadow-sm border border-bread-100 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                            <i class="fas fa-chart-bar text-bread-600"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-bread-800">Forecasting (S-ARIMA)</h3>
                            <p class="text-bread-500 text-sm">Prediksi tren penjualan dan kebutuhan stok</p>
                        </div>
                    </div>

                    @isset($message)
                        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-lg mb-4">
                            {{ $message }}
                        </div>
                    @elseif(isset($forecastDates))
                        {{-- 📈 Forecast Chart Section --}}
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200 mb-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-chart-line text-bread-600"></i>
                                </div>
                                <h5 class="font-semibold text-bread-800">Prediksi Penjualan</h5>
                            </div>
                            <p class="text-bread-600 text-sm mb-4">
                                Forecast penjualan harian/mingguan berdasarkan data historis.
                            </p>
                            <div class="relative" style="height:400px;">
                                <canvas id="forecastChart"></canvas>
                            </div>
                        </div>

                        {{-- 📦 Stock Optimization Section --}}
                        <div class="bg-bread-25 rounded-lg p-4 border border-bread-200 mb-6">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 rounded-lg bg-bread-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-boxes text-bread-600"></i>
                                </div>
                                <h5 class="font-semibold text-bread-800">Optimasi Stok</h5>
                            </div>
                            <p class="text-bread-600 text-sm mb-4">
                                Rekomendasi stok berdasarkan prediksi permintaan per produk.
                            </p>

                            @if(!empty($productForecasts))
                                <table class="w-full text-sm mb-4">
                                    <thead>
                                        <tr class="bg-bread-50 text-bread-700">
                                            <th class="py-2 px-3 text-left">Produk</th>
                                            <th class="py-2 px-3 text-right">Rata-rata Prediksi</th>
                                            <th class="py-2 px-3 text-right">Stok Disarankan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-bread-100">
                                        @foreach($productForecasts as $name => $pf)
                                            @php $suggested = ceil($pf['avg'] * 1.2); @endphp
                                            <tr>
                                                <td class="py-2 px-3 text-bread-800 font-medium">{{ $name }}</td>
                                                <td class="py-2 px-3 text-right">{{ number_format($pf['avg'], 0, ',', '.') }}</td>
                                                <td class="py-2 px-3 text-right font-semibold text-green-700">{{ $suggested }} pcs</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                            <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                                <p class="text-green-800 text-lg font-bold">
                                    Total Stok Optimal Disarankan: {{ $recommendedStock }} pcs
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <i class="fas fa-chart-line text-bread-400 text-5xl mb-4"></i>
                            <h4 class="text-xl font-semibold text-bread-800 mb-2">Belum Ada Hasil Forecast</h4>
                            <p class="text-bread-600 mb-6">Klik tombol di bawah ini untuk menjalankan analisis dan prediksi penjualan.</p>
                            <form action="{{ route('owner.reports.forecast') }}" method="GET">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 bg-bread-600 hover:bg-bread-700 text-white rounded-lg font-medium transition-colors duration-200 shadow-sm">
                                    <i class="fas fa-play mr-2"></i> Generate Forecast
                                </button>
                            </form>
                        </div>
                    @endisset
                </div>
            </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // 🔹 Automatically open the correct tab if provided by controller (e.g., forecast)
            const activeTab = "{{ $activeTab ?? 'stok' }}";
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabPanes = document.querySelectorAll('.tab-pane');

            // Initialize tabs based on activeTab
            tabButtons.forEach(btn => {
                const tabName = btn.getAttribute('data-tab');
                const pane = document.getElementById(`${tabName}-tab`);
                if (tabName === activeTab) {
                    btn.classList.add('active');
                    pane.classList.remove('hidden');
                } else {
                    btn.classList.remove('active');
                    pane.classList.add('hidden');
                }
            });

            // Handle manual tab clicks
            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const targetTab = this.getAttribute('data-tab');
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    tabPanes.forEach(pane => pane.classList.add('hidden'));
                    document.getElementById(`${targetTab}-tab`).classList.remove('hidden');
                });
            });

            // Existing chart.js logic
            const ctx = document.getElementById("salesChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: {!! json_encode($chartLabels ?? []) !!},
                    datasets: [{
                        label: "Total Penjualan (Rp)",
                        data: {!! json_encode($chartValues ?? []) !!},
                        backgroundColor: "rgba(199, 122, 61, 0.6)",
                        borderColor: "rgba(199, 122, 61, 1)",
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false }},
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => 'Rp ' + value.toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script>
    let forecastChart = null;

    function renderForecastChart() {
        const chartEl = document.getElementById("forecastChart");
        if (!chartEl) return;

        const productForecasts = {!! json_encode($productForecasts ?? []) !!};
        if (!productForecasts || Object.keys(productForecasts).length === 0) {
            console.warn("⚠️ No forecast data available.");
            return;
        }

        // Use first product's dates for X-axis
        const firstProduct = Object.keys(productForecasts)[0];
        const labels = productForecasts[firstProduct]?.dates ?? [];

        const randomColor = () => 
            `rgba(${Math.floor(Math.random()*200)}, ${Math.floor(Math.random()*200)}, ${Math.floor(Math.random()*200)},`;

        const datasets = Object.entries(productForecasts).map(([name, pf]) => {
            const color = randomColor();
            return {
                label: name,
                data: pf.values,
                borderColor: color + "1)",
                backgroundColor: color + "0.25)",
                tension: 0.3,
                borderWidth: 2,
                fill: false
            };
        });

        if (forecastChart) forecastChart.destroy();
        forecastChart = new Chart(chartEl.getContext("2d"), {
            type: "line",
            data: { labels, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: "📈 Prediksi Penjualan per Produk (14 Hari ke Depan)",
                        font: { size: 16 },
                        color: "#1f2937"
                    },
                    legend: { position: "bottom" }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: "Jumlah Terjual (pcs)" },
                        ticks: { callback: v => v.toLocaleString("id-ID") + " pcs" }
                    },
                    x: {
                        title: { display: true, text: "Tanggal" }
                    }
                }
            }
        });
    }

    // 🟢 Trigger after tab becomes visible (with delay)
    document.addEventListener("DOMContentLoaded", () => {
        const forecastBtn = document.querySelector("[data-tab='forecast']");
        const forecastPane = document.getElementById("forecast-tab");

        const activateAndRender = () => {
            if (forecastPane && !forecastPane.classList.contains("hidden")) {
                setTimeout(renderForecastChart, 300); // small delay ensures layout is ready
            }
        };

        // When switching tab manually
        if (forecastBtn) forecastBtn.addEventListener("click", activateAndRender);

        // If it's already active from backend
        if ("{{ $activeTab ?? '' }}" === "forecast") {
            activateAndRender();
        }
    });
    </script>


    <style>
        .tab-button {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: #6b7280;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            white-space: nowrap;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .tab-button:hover {
            color: #374151;
            border-bottom-color: #d1d5db;
        }

        .tab-button.active {
            color: #ea580c;
            border-bottom-color: #ea580c;
        }

        .tab-button {
            @apply flex items-center px-4 py-3 md:px-6 md:py-4 text-gray-600 font-medium border-b-2 border-transparent whitespace-nowrap transition-all duration-200 cursor-pointer;
        }

        .tab-button:hover {
            @apply text-gray-800 border-gray-300;
        }

        .tab-button.active {
            @apply text-bread-700 border-bread-600 font-semibold;
        }

        .tab-content-area {
            transition: opacity 0.3s ease;
        }
    </style>
@endsection
