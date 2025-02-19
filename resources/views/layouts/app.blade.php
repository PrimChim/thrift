<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thrift Store')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 text-white">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <h1 class="text-xl font-bold">Thrift Store</h1>
            <div class="flex items-center gap-4">
                <input type="text" placeholder="Search products" class="rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg">Search</button>
                <a href="/login" class="text-white">Login</a>
                <a href="/register" class="bg-orange-500 text-white px-4 py-2 rounded-lg">Cart</a>
            </div>
        </div>
    </header>

    <!-- Categories Section -->
    <section class="bg-white shadow">
        <div class="container mx-auto flex gap-6 py-4 px-6">
            <a href="#" class="text-gray-700 hover:text-blue-500">Electronics</a>
            <a href="#" class="text-gray-700 hover:text-blue-500">Fashion</a>
            <a href="#" class="text-gray-700 hover:text-blue-500">Home & Living</a>
            <a href="#" class="text-gray-700 hover:text-blue-500">Sports</a>
            <a href="#" class="text-gray-700 hover:text-blue-500">Books</a>
            <a href="#" class="text-gray-700 hover:text-blue-500">More...</a>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8" style="min-height: 79vh;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>© 2025 Thrift Store. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
