@extends('layouts.admin')

@section('title', 'Show Product')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <h2 class="text-3xl font-semibold mb-4">{{ $product->name }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-lg font-medium text-gray-700"><strong>Description:</strong> {{ $product->description ?? 'No description available' }}</p>
            <p class="text-lg font-medium text-gray-700"><strong>Price:</strong> Rs.{{ number_format($product->price, 2) }}</p>
            <p class="text-lg font-medium text-gray-700"><strong>Quantity:</strong> {{ $product->quantity }}</p>
            <p class="text-lg font-medium text-gray-700"><strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}</p>

            @if ($product->image_url)
                <div class="mt-4">
                    <strong class="text-lg text-gray-700">Product Image:</strong>
                    <img src="{{ Storage::url($product->image_url) }}" alt="Product Image" class="w-64 h-64 object-cover mt-2 rounded-md">
                </div>
            @endif
        </div>

        <div class="flex items-center justify-center space-x-4">
            <a href="{{ route('products.edit', $product->id) }}" 
               class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400">
                Edit
            </a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
