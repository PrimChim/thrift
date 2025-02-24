@extends('layouts.admin')

@section('title', 'Order Details | Nidhi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-900">
            &larr; Back to Orders
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded border">
            <h2 class="font-bold text-lg mb-2">Order Information</h2>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y h:i A') }}</p>
            <p><strong>Status:</strong>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                        {{ $order->status == 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total Amount:</strong> Rs. {{ number_format($order->total_price, 2) }}</p>

            <div class="mt-4">
                <h3 class="font-bold">Update Status</h3>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-2 flex space-x-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="border rounded-md px-3 py-2 flex-grow">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600">Update</button>
                </form>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded border">
            <h2 class="font-bold text-lg mb-2">Customer Information</h2>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <h2 class="font-bold text-lg mb-2">Order Details</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Product
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Price
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Quantity
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex items-center">
                                @if($order->product && isset($order->product->image))
                                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="h-10 w-10 object-cover mr-3">
                                @else
                                <div class="h-10 w-10 bg-gray-200 mr-3"></div>
                                @endif
                                <div>
                                    {{ $order->product->name ?? 'Product not available' }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            Rs. {{ number_format($order->total_price / $order->quantity, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ $order->quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            Rs. {{ number_format($order->total_price, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection