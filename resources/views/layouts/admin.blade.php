<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thrift Store')</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Playwrite+CO+Guides&display=swap');
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sticky Navbar -->
    <nav class="bg-gray-900 text-white p-4 sticky top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-5xl font-bold" style="font-family: 'Kaushan Script', serif; font-weight: 800; font-style: normal;">
                <span style="color: #cc7bbe;">Ni</span><span style="color: #88682c;">dhi</span>
            </a>
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
            <a href="{{ route('categories.index') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">✅ Categories</a>
            <a href="{{ route('admin.orders.index') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">🛍️ Orders</a>
            <a href="{{ route('users.index') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">👥 Users</a>
            <a href="{{ route('admin.profile') }}" class="block py-2 px-3 hover:bg-gray-700 rounded">👤 Profile</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        @yield('content')
    </main>

</body>

</html>