@extends('layouts.admin')

@section('title', 'Manage Orders | Nidhi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Order Management</h1>

    <div class="mb-4">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex gap-2">
            <input type="text" name="search" placeholder="Search by order ID or customer name"
                class="border rounded-md px-3 py-2 w-full max-w-md" value="{{ request('search') }}">
            <select name="status" class="border rounded-md px-3 py-2">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600">Filter</button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Order ID
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Customer
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Product
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        #{{ $order->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        {{ $order->user->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        {{ $order->product->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        {{ $order->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        Rs. {{ number_format($order->total_price, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status == 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                                    {{ $order->status == 'delivered' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                        {{ $order->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-right text-sm font-medium">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 border-b border-gray-200 text-center">
                        No orders found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection