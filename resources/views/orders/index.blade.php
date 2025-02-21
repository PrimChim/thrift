@extends('layouts.app')

@section('title', 'Orders - Nidhi')

@section('content')
<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <h1 class="text-2xl font-bold">Your Orders</h1>
    @if (session('success'))
    <div class="mb-4 p-5 bg-green-300 text-white">
        {{ session('success') }}
    </div>
    @endif
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Order Id</th>
                <th class="py-3 px-6 text-left">Image</th>
                <th class="py-3 px-6 text-left">Product Name</th>
                <th class="py-3 px-6 text-left">Quantity</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($orders as $order)
            <tr class="border-b border-gray-200 hover:bg-white">
                <td class="py-3 px-6">
                    {{$order->id}}
                </td>
                <td class="py-3 px-6">
                    <img src="/storage/{{$order->product->image_url}}" class="h-16 w-16" alt="">
                </td>
                <td class="py-3 px-6">
                    {{$order->product->name}}
                </td>
                <td class="py-3 px-6">
                    {{$order->quantity}}
                </td>
                <td class="py-3 px-6">
                    {{$order->total_price}}
                </td>
                <td class="py-3 px-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('orders.show', $order->id) }}"
                            class="text-blue-500 hover:underline">View</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center py-4">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection