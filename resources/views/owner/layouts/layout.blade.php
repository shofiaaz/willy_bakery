<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

    <aside class="w-64 bg-gray-800 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-8">Owner Panel</h2>
        <ul class="space-y-3">
            <li><a href="{{ route('owner.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700">📊
                    Dashboard</a></li>
            <li>
                <form action="{{ route('owner.logout') }}" method="POST">
                    @csrf
                    <button class="w-full text-left py-2 px-3 rounded hover:bg-red-600">🚪 Logout</button>
                </form>
            </li>
        </ul>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>

</html>
