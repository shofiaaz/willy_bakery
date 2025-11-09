<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Owner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow w-96">
        <h1 class="text-2xl font-bold text-center mb-6">Login Owner</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('owner.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                Login
            </button>
        </form>
    </div>

</body>

</html>
