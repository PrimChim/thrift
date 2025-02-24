@extends('layouts.app')

@section('title', 'Checkout - Nidhi')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if(session('error'))
        <div class="mb-4 p-5 bg-red-300 text-white">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden p-6">
        <h2 class="text-lg font-bold mb-4">Order Summary</h2>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">Rs. {{ number_format($item->quantity * $item->product->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6 text-lg font-semibold">
            Total: Rs. {{ number_format($total, 2) }}
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Place Order
            </button>
        </form>
    </div>
</div>
@endsection
