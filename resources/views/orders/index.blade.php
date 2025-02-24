@extends('layouts.app')

@section('title', 'Orders - Nidhi')

@section('content')
<div class="flex">
    <aside class="w-64 flex flex-col space-y-4">
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('profile.index') ? 'font-bold text-blue-600' : '' }}" 
           href="{{ route('user.profile') }}">Manage My Profile</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('order.index') ? 'font-bold text-blue-600' : '' }}" 
           href="{{ route('order.index') }}">My Orders</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('cart.index') ? 'font-bold text-blue-600' : '' }}" 
           href="{{ route('cart.index') }}">My Cart</a>
    </aside>
    <main class="flex-1">
        <h1 class="text-2xl font-bold">Your Orders</h1>

        @if (session('success'))
        <div class="mb-4 p-5 bg-green-300 text-white">
            {{ session('success') }}
        </div>
        @endif

        <table class="min-w-full table-auto mt-4">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Order Id</th>
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-left">Product Name</th>
                    <th class="py-3 px-6 text-left">Quantity</th>
                    <th class="py-3 px-6 text-left">Price</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-white">
                    <td class="py-3 px-6">#{{ $order->id }}</td>
                    <td class="py-3 px-6">
                        <img src="/storage/{{ $order->product->image_url }}" class="h-16 w-16" alt="">
                    </td>
                    <td class="py-3 px-6">{{ $order->product->name }}</td>
                    <td class="py-3 px-6">{{ $order->quantity }}</td>
                    <td class="py-3 px-6">{{ $order->total_price }}</td>
                    <td class="py-3 px-6">
                        @if ($order->status == 'pending')
                        <span class="bg-yellow-300 text-yellow-800 py-1 px-3 rounded-full">Pending</span>
                        @elseif ($order->status == 'delivered')
                        <span class="bg-green-300 text-green-800 py-1 px-3 rounded-full">Delivered</span>
                        @else
                        <span class="bg-gray-300 text-gray-800 py-1 px-3 rounded-full">Unknown</span>
                        @endif
                    </td>
                    <td class="py-3 px-6">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('order.show', $order->id) }}" class="text-blue-500 hover:underline">View</a>
                            <form action="{{ route('order.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>
@endsection
