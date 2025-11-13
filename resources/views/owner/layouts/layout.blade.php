<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Toko Roti</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'bread': {
                            50: '#fdf8f3',
                            100: '#f7e8d9',
                            200: '#eed3b4',
                            300: '#e2b585',
                            400: '#d49256',
                            500: '#c77a3d',
                            600: '#b86533',
                            700: '#99502c',
                            800: '#7b4129',
                            900: '#643724',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #7b4129 0%, #643724 100%);
        }

        .card-shadow {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .hover-lift:hover {
            transform: translateY(-3px);
            transition: transform 0.2s ease;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .active-nav {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #d49256;
        }

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
    </style>
</head>

<body class="bg-bread-50 flex">
    <aside class="w-64 sidebar-gradient text-white min-h-screen flex flex-col sticky top-0">
        <div class="p-6 border-b border-bread-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-bread-400 flex items-center justify-center">
                    <i class="fas fa-bread-slice text-white"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Willy Bakery</h2>
                    <p class="text-bread-200 text-sm">Owner Panel</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('owner.dashboard') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200 {{ request()->routeIs('owner.dashboard') ? 'active-nav' : '' }}">
                        <i class="fas fa-chart-line w-5 mr-3 text-bread-300"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.suppliers.index') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200 {{ request()->routeIs('owner.suppliers.index') ? 'active-nav' : '' }}">
                        <i class="fas fa-truck w-5 mr-3 text-bread-300"></i>
                        <span>Manajemen Supplier</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.purchases.index') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200 {{ request()->routeIs('owner.purchases.index') ? 'active-nav' : '' }}">
                        <i class="fas fa-shopping-basket w-5 mr-3 text-bread-300"></i>
                        <span>Pembelian Bahan Baku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.sales.index') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200 {{ request()->routeIs('owner.sales.index') ? 'active-nav' : '' }}">
                        <i class="fas fa-shopping-basket w-5 mr-3 text-bread-300"></i>
                        <span>Pembelian dan Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200">
                        <i class="fas fa-boxes w-5 mr-3 text-bread-300"></i>
                        <span>Stok Produk</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200">
                        <i class="fas fa-users w-5 mr-3 text-bread-300"></i>
                        <span>Manajemen Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('owner.reports.index') }}"
                        class="flex items-center py-3 px-4 rounded-lg hover:bg-bread-700 transition-colors duration-200 {{ request()->routeIs('owner.reports.index') ? 'active-nav' : '' }}">
                        <i class="fas fa-shopping-basket w-5 mr-3 text-bread-300"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t border-bread-700">
            <form action="{{ route('owner.logout') }}" method="POST">
                @csrf
                <button
                    class="flex items-center w-full py-3 px-4 rounded-lg hover:bg-red-700 transition-colors duration-200 text-red-200 hover:text-white">
                    <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>

</html>
