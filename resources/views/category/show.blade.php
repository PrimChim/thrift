@extends('layouts.app')

@section('title', $category->name . ' - Thrift Store')

@section('content')
<h2 class="text-2xl font-bold mb-6">{{ $category->name }}</h2>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach($products as $product)
    <div class="bg-white rounded-lg shadow p-4">
        <!-- Link to product page -->
        <a href="/product/{{ $product->id }}">
            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded">
            <h3 class="text-lg font-semibold mt-4">{{ $product->name }}</h3>
            <p class="text-gray-500">Rs. {{ number_format($product->price, 2) }}</p>
        </a>
        <a href="/product/{{ $product->id }}" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg w-full text-center block">View Product</a>
        <!-- Button (optional) for adding to cart or more actions -->
        <form action="{{ route('cart.store', $product) }}" method="POST">
            @csrf
            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg w-full">Add to Cart</button>
        </form>
        <form action="{{ route('buy.now', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg w-full hover:cursor-pointer">
                Buy Now
            </button>
        </form>
    </div>
    @endforeach
</div>
@endsection