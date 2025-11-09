@extends('owner.layouts.layout')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-bread-800">Dashboard Owner</h1>
        <p class="text-bread-600 mt-2">Selamat datang! Berikut adalah ringkasan performa toko roti Anda.</p>
    </div>

    <div x-data="{ filter: '{{ request('filter_type', '7_days') }}' }" class="mb-8 bg-white rounded-2xl card-shadow p-6">
        <h2 class="text-lg font-semibold text-bread-800 mb-4 flex items-center">
            <i class="fas fa-filter text-bread-500 mr-2"></i> Filter Laporan
        </h2>
        <form action="{{ route('owner.dashboard.filter') }}" method="POST" class="flex flex-wrap items-center gap-4">
            @csrf
            <div class="flex items-center">
                <select name="filter_type" x-model="filter"
                    class="border border-bread-200 rounded-xl p-3 bg-bread-50 focus:outline-none focus:ring-2 focus:ring-bread-300 focus:border-transparent">
                    <option value="7_days">7 Hari Terakhir</option>
                    <option value="30_days">30 Hari Terakhir</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>

            <div x-show="filter === 'custom'" class="flex gap-2 items-center">
                <div class="relative">
                    <input type="date" name="start_date" value="{{ $startDate }}"
                        class="border border-bread-200 rounded-xl p-3 bg-bread-50 focus:outline-none focus:ring-2 focus:ring-bread-300 focus:border-transparent">
                </div>
                <span class="text-bread-500">-</span>
                <div class="relative">
                    <input type="date" name="end_date" value="{{ $endDate }}"
                        class="border border-bread-200 rounded-xl p-3 bg-bread-50 focus:outline-none focus:ring-2 focus:ring-bread-300 focus:border-transparent">
                </div>
            </div>

            <button
                class="bg-bread-600 hover:bg-bread-700 text-white font-semibold px-5 py-3 rounded-xl transition-colors duration-200 flex items-center">
                <i class="fas fa-chart-bar mr-2"></i>
                Tampilkan Laporan
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-bread-600 text-sm font-medium">Total Penjualan</p>
                    <h3 class="text-3xl font-bold text-bread-800 mt-2">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                    <div class="flex items-center mt-3">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                            <i class="fas fa-arrow-up mr-1 text-xs"></i> 12.5%
                        </span>
                        <span class="text-bread-500 text-sm ml-2">dari bulan lalu</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-bread-600 text-sm font-medium">Total Supplier</p>
                    <h3 class="text-3xl font-bold text-bread-800 mt-2">{{ $totalSuppliers }}</h3>
                    <div class="flex items-center mt-3">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                            <i class="fas fa-plus mr-1 text-xs"></i> 2 baru
                        </span>
                        <span class="text-bread-500 text-sm ml-2">bulan ini</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-truck text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card bg-white rounded-2xl card-shadow p-6 hover-lift">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-bread-600 text-sm font-medium">Pembelian Bahan Baku</p>
                    <h3 class="text-3xl font-bold text-bread-800 mt-2">Rp {{ number_format($totalPurchases, 0, ',', '.') }}
                    </h3>
                    <div class="flex items-center mt-3">
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                            <i class="fas fa-arrow-down mr-1 text-xs"></i> 5.2%
                        </span>
                        <span class="text-bread-500 text-sm ml-2">dari bulan lalu</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-shopping-basket text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl card-shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-bread-800 flex items-center">
                    <i class="fas fa-chart-line text-bread-500 mr-2"></i> Grafik Penjualan
                </h2>
                <div class="text-sm text-bread-500">
                    <i class="fas fa-circle text-green-500 mr-1 text-xs"></i> Penjualan
                </div>
            </div>
            <div class="chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl card-shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-bread-800 flex items-center">
                    <i class="fas fa-chart-bar text-bread-500 mr-2"></i> Grafik Pembelian
                </h2>
                <div class="text-sm text-bread-500">
                    <i class="fas fa-circle text-yellow-500 mr-1 text-xs"></i> Pembelian
                </div>
            </div>
            <div class="chart-container">
                <canvas id="purchaseChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl card-shadow p-6">
        <h2 class="text-lg font-semibold text-bread-800 mb-4 flex items-center">
            <i class="fas fa-bolt text-bread-500 mr-2"></i> Akses Cepat
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('owner.suppliers.index') }}"
                class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mb-2">
                    <i class="fas fa-truck text-blue-600 text-xl"></i>
                </div>
                <span class="text-bread-700 font-medium text-sm text-center">Kelola Supplier</span>
            </a>

            <a href="{{ route('owner.purchases.index') }}"
                class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center mb-2">
                    <i class="fas fa-shopping-basket text-yellow-600 text-xl"></i>
                </div>
                <span class="text-bread-700 font-medium text-sm text-center">Pembelian Bahan</span>
            </a>

            <a href="#"
                class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center mb-2">
                    <i class="fas fa-boxes text-purple-600 text-xl"></i>
                </div>
                <span class="text-bread-700 font-medium text-sm text-center">Stok Produk</span>
            </a>

            <a href="#"
                class="flex flex-col items-center justify-center p-4 border border-bread-200 rounded-xl hover:bg-bread-50 transition-colors duration-200">
                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mb-2">
                    <i class="fas fa-file-invoice-dollar text-green-600 text-xl"></i>
                </div>
                <span class="text-bread-700 font-medium text-sm text-center">Laporan Keuangan</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        const salesDates = ['1 Nov', '2 Nov', '3 Nov', '4 Nov', '5 Nov', '6 Nov', '7 Nov'];
        const salesTotals = [1200000, 1850000, 1500000, 2100000, 1800000, 1950000, 2200000];
        const purchaseDates = ['1 Nov', '2 Nov', '3 Nov', '4 Nov', '5 Nov', '6 Nov', '7 Nov'];
        const purchaseTotals = [750000, 920000, 680000, 810000, 730000, 890000, 950000];

        document.addEventListener('DOMContentLoaded', function () {
            const salesCtx = document.getElementById('salesChart');
            const purchaseCtx = document.getElementById('purchaseChart');

            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: salesDates,
                    datasets: [{
                        label: 'Total Penjualan',
                        data: salesTotals,
                        borderColor: 'rgb(34,197,94)',
                        backgroundColor: 'rgba(34,197,94,0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: 'rgb(34,197,94)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            new Chart(purchaseCtx, {
                type: 'bar',
                data: {
                    labels: purchaseDates,
                    datasets: [{
                        label: 'Total Pembelian',
                        data: purchaseTotals,
                        backgroundColor: 'rgba(234,179,8,0.7)',
                        borderColor: 'rgb(202,138,4)',
                        borderWidth: 1,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                callback: function (value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
