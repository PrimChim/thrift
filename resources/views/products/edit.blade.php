@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <!-- Category -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
                <option value="1" {{ old('category_id', $product->category_id) == 1 ? 'selected' : '' }}>Category 1</option>
                <option value="2" {{ old('category_id', $product->category_id) == 2 ? 'selected' : '' }}>Category 2</option>
                <option value="3" {{ old('category_id', $product->category_id) == 3 ? 'selected' : '' }}>Category 3</option>
            </select>
        </div>

        <!-- Product Image -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
            @if ($product->image_url)
            <div class="mb-2">
                <img src="{{ Storage::url($product->image_url) }}" alt="Current Image"
                    class="w-32 h-32 object-cover rounded-md">
            </div>
            @endif
            <input type="file" name="image" id="image"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
