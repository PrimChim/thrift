@extends('layouts.app')

@section('title', $product->name . ' - Thrift Store')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <!-- Product Details Section -->
    <div class="flex flex-col md:flex-row items-center">
        <!-- Product Image -->
        <div class="w-full md:w-1/2 mb-6 md:mb-0">
            @if($product->image_url)
            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-md shadow-md">
            @else
            <img src="https://via.placeholder.com/400" alt="No Image Available" class="w-full h-auto object-cover rounded-md shadow-md">
            @endif
        </div>

        <!-- Product Info -->
        <div class="w-full md:w-1/2 md:ml-6">
            <h2 class="text-3xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
            <p class="text-lg text-gray-600 mb-4">{{ $product->description ?? 'No description available' }}</p>

            <div class="text-xl font-bold text-gray-800 mb-4">Rs. {{ number_format($product->price, 2) }}</div>

            <div class="flex items-center justify-between">
                <!-- Add to Cart / Buy Now Button -->

                <form action="{{ route('buy.now', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg w-full hover:cursor-pointer">
                        Buy Now
                    </button>
                </form>


                <!-- Quantity -->
                <div class="flex items-center">
                    <label for="quantity" class="text-sm font-medium text-gray-700 mr-2">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-16 text-center border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection