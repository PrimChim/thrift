<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thrift Store')</title>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Playwrite+CO+Guides&display=swap');
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-200 text-white">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="/" class="text-5xl font-bold" style="font-family: 'Kaushan Script', serif; font-weight: 800; font-style: normal;">
                <span style="color: #cc7bbe;">Ni</span><span style="color: #88682c;">dhi</span>
            </a>
            <div class="flex items-center gap-4">
                <form action="{{ route('search.products') }}" method="GET" class="flex">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products"
                        class="border text-gray-800 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-orange-500">Search</button>
                </form>
                @guest
                <a href="/login" class="text-orange-500 bg-white border border-white hover:bg-orange-300 hover:border-orange-300 hover:text-white rounded-lg px-4 py-2">Login</a>
                @else
                <a href="/profile" class="hover:cursor-pointer">
                    Welcome, <span class="underline text-orange-500"> {{Auth::user()->name}}</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-400 hover:text-red-300">Logout?</button>
                </form>
                @endguest
                @guest
                <a href="/register" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-orange-500">Register</a>
                @else
                @if(Auth::user()->role === 'admin')
                <a href="/dashboard" class="ml-4 text-green-500 bg-white border border-green-500 hover:bg-green-500 hover:text-white rounded-lg px-4 py-2">Admin Panel</a>
                @else
                <a href="/cart" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-white hover:text-orange-500">Cart</a>
                @endif
                @endguest
            </div>
        </div>
    </header>

    <!-- Categories Section -->
    <section class="bg-white shadow">
        <div class="container mx-auto flex gap-6 py-4 px-6">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->id) }}" class="text-gray-700 hover:text-blue-500">
                {{ $category->name }}
            </a>
            @endforeach
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