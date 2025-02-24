@extends('layouts.app')

@section('title', 'Carts - Nidhi')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 flex flex-col space-y-4">
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('user.profile') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('user.profile') }}">Manage My Profile</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('order.index') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('order.index') }}">My Orders</a>
        <a class="text-blue-400 hover:text-blue-300 {{ request()->routeIs('cart.index') ? 'font-bold text-blue-600' : '' }}"
            href="{{ route('cart.index') }}">My Cart</a>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 px-6 py-8">
        <h1 class="text-2xl font-bold mb-6 text-blue-300">Shopping Cart</h1>

        @if($cartItems->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img class="h-16 w-16 object-cover rounded" src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">Rs. {{ number_format($item->product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 rounded border-gray-300">
                                <button type="submit" class="ml-2 text-sm text-blue-600 hover:text-blue-800">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">Rs. {{ number_format($item->quantity * $item->product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4 bg-gray-50">
                <div class="text-right">
                    <div class="text-lg font-semibold">Total: Rs. {{ number_format($total, 2) }}</div>
                    <a href="{{ route('checkout.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">Your cart is empty</p>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Continue Shopping</a>
        </div>
        @endif
    </main>
</div>
@endsection