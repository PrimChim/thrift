@extends('layouts.app')

@section('title', 'Home - Thrift Store') <!-- Optional: Set a custom title for this page -->

@section('content')
    <!-- Featured Products Section -->
    <section>
        <h2 class="text-2xl font-bold mb-6">Featured Products</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow p-4">
                <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded">
                <h3 class="text-lg font-semibold mt-4">{{ $product->name }}</h3>
                <p class="text-gray-500">Rs. {{ number_format($product->price, 2) }}</p>
                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg w-full">Add to Cart</button>
            </div>
            @endforeach
        </div>
    </section>
@endsection