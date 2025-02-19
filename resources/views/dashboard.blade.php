@extends('layouts.admin')

@section('title', 'Dashboard - Thrift')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h5 class="text-xl font-bold">Profile</h5>
        <p class="text-gray-700 mt-2">
            <span class="font-semibold">Name:</span> {{ Auth::user()->name }} <br>
            <span class="font-semibold">Email:</span> {{ Auth::user()->email }}
        </p>
    </div>

    <!-- Dashboard Content -->
    <div class="md:col-span-2 bg-white shadow-md rounded-lg p-6">
        <h5 class="text-xl font-bold">Dashboard Content</h5>
        <p class="text-gray-700 mt-2">Welcome to your dashboard! Here you can manage your content.</p>
    </div>
</div>

<!-- Stats Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
    <!-- Total Products -->
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
        <h5 class="text-lg font-semibold">Total Products</h5>
        <p class="text-2xl font-bold mt-2">{{ $totalProducts }}</p>
    </div>

    <!-- Out-of-Stock Products -->
    <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
        <h5 class="text-lg font-semibold">Out of Stock</h5>
        <p class="text-2xl font-bold mt-2">{{ $outOfStockProducts }}</p>
    </div>

    <!-- This Week's Revenue -->
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
        <h5 class="text-lg font-semibold">This Week’s Revenue</h5>
        <p class="text-2xl font-bold mt-2">$0.00</p>
    </div>

    <!-- This Month's Revenue -->
    <div class="bg-cyan-500 text-white p-6 rounded-lg shadow-md">
        <h5 class="text-lg font-semibold">This Month’s Revenue</h5>
        <p class="text-2xl font-bold mt-2">$0.00</p>
    </div>
</div>
@endsection