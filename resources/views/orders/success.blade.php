@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto text-center bg-green-300 py-4">
        <h2 class="text-2xl font-bold">Order Placed Successfully!</h2>
        <p>Your order for <strong>{{ $order->product->name }}</strong> has been placed.</p>
        <a href="{{ route('home') }}" class="mt-4 inline-block text-blue-500 hover:text-blue-400">Back to Home</a>
    </div>
@endsection
