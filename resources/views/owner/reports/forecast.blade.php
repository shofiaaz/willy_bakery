@extends('owner.layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
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
        @else
            {{-- 🟢 Forecast Chart Section --}}
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

                <div class="relative w-full h-[420px]">
                    <canvas id="forecastChart"></canvas>
                </div>
            </div>

            {{-- 🟢 Stock Optimization Section --}}
            <div class="bg-bread-25 rounded-lg p-4 border border-bread-200">
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
        @endisset
    </div>
</div>

{{-- ✅ Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const chartEl = document.getElementById("forecastChart");
    if (!chartEl) return;

    const productForecasts = {!! json_encode($productForecasts ?? []) !!};
    if (!productForecasts || Object.keys(productForecasts).length === 0) {
        console.warn("⚠️ No forecast data found");
        return;
    }

    const firstProduct = Object.keys(productForecasts)[0];
    const labels = productForecasts[firstProduct]?.dates ?? [];

    const randomColor = () =>
        `rgba(${Math.floor(Math.random() * 180)}, ${Math.floor(Math.random() * 150)}, ${Math.floor(Math.random() * 100)},`;

    const datasets = Object.entries(productForecasts).map(([name, pf]) => {
        const color = randomColor();
        return {
            label: name,
            data: pf.values,
            borderColor: color + "1)",
            backgroundColor: color + "0.2)",
            borderWidth: 2,
            tension: 0.35,
            fill: false,
        };
    });

    // Destroy existing chart (if any)
    if (window.forecastChart) window.forecastChart.destroy();

    // Delay rendering slightly to allow layout sizing
    setTimeout(() => {
        window.forecastChart = new Chart(chartEl.getContext("2d"), {
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
                    legend: {
                        display: true,
                        position: "bottom",
                        labels: {
                            color: "#374151",
                            boxWidth: 20,
                            usePointStyle: true
                        }
                    },
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
    }, 400); // Delay 400ms ensures container height is ready
});
</script>
@endsection
