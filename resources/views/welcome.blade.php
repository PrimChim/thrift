@extends('layouts.app')

@section('title', 'Home - Thrift Store') <!-- Optional: Set a custom title for this page -->

@section('content')
<!-- Featured Products Section -->
<section>
    <h2 class="text-2xl font-bold mb-6">Featured Products</h2>
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
            <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg w-full">Add to Cart</button>
            <form action="{{ route('buy.now', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg w-full">
                    Buy Now
                </button>
            </form>
        </div>
        @endforeach
    </div>
</section>
@endsection