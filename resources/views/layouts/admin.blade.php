<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thrift Store')</title>
    @vite('resources/css/app.css')  {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-bold">Thrift Store</a>
            <div class="flex items-center space-x-4">
                <span>Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen fixed p-5">
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">🏠 Dashboard</a>
            <a href="{{ route('products.index') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">📦 Inventory</a>
            <a href="#" class="block py-2 px-3 hover:bg-gray-700 rounded">👤 Profile</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        @yield('content')
    </main>

</body>

</html>
