<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Supplier - Willy Bakery</title>
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
        .login-bg {
            background: linear-gradient(135deg, #fdf8f3 0%, #f7e8d9 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 30px rgba(123, 65, 41, 0.15);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(212, 146, 86, 0.3);
            border-color: #d49256;
        }
    </style>
</head>

<body class="login-bg flex items-center justify-center min-h-screen p-4 relative">
    <div class="fixed top-10 left-10 w-20 h-20 rounded-full bg-bread-200 opacity-20 floating"></div>
    <div class="fixed bottom-10 right-10 w-32 h-32 rounded-full bg-bread-300 opacity-20 floating" style="animation-delay: 1.5s;"></div>
    <div class="fixed top-1/3 right-20 w-16 h-16 rounded-full bg-bread-400 opacity-20 floating" style="animation-delay: 1s;"></div>

    <a href="{{ route('home') }}"
    class="absolute top-6 left-6 text-bread-700 hover:text-bread-900 text-sm font-semibold flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>

    <div class="relative z-10 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-bread-500 to-bread-700 mb-4 card-shadow">
                <i class="fas fa-truck text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-bread-800">Willy Bakery</h1>
            <p class="text-bread-600 mt-2">Login Panel Supplier</p>
        </div>

        <div class="bg-white rounded-2xl card-shadow p-8">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-medium">Login Gagal</span>
                    </div>
                    @foreach ($errors->all() as $error)
                        <p class="mt-1 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('supplier.login.post') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-bread-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-user mr-2 text-bread-500"></i>
                        Nama Kontak
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="contact_person"
                            class="w-full border border-bread-200 rounded-xl p-4 pl-12 bg-bread-50 input-focus transition-all duration-200 focus:bg-white"
                            placeholder="Masukkan nama kontak"
                            required
                            value="{{ old('contact_person') }}"
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-bread-400">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-bread-700 font-semibold mb-2 flex items-center">
                        <i class="fas fa-phone mr-2 text-bread-500"></i>
                        Nomor Telepon
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="phone"
                            class="w-full border border-bread-200 rounded-xl p-4 pl-12 bg-bread-50 input-focus transition-all duration-200 focus:bg-white"
                            placeholder="Masukkan nomor telepon"
                            required
                        >
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-bread-400">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-bread-600">
                        <input type="checkbox" name="remember" class="rounded border-bread-300 text-bread-600 focus:ring-bread-500">
                        <span class="ml-2 text-sm">Ingat saya</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-bread-600 to-bread-700 hover:from-bread-700 hover:to-bread-800 text-white font-bold py-4 px-4 rounded-xl transition-all duration-200 transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center"
                >
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-bread-100 text-center">
                <p class="text-bread-500 text-sm">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Akses terbatas untuk supplier toko roti
                </p>
            </div>
        </div>

        <div class="text-center mt-6">
            <p class="text-bread-500 text-sm">
                &copy; 2025 Willy Bakery. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
