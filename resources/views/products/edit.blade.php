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

        <!-- Category Selection with "New Category" Button -->
        <div>
            <div class="flex justify-between">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <!-- Button to Open Modal -->
                <a type="button" id="openModalBtn"
                    class="text-blue-500 text-sm rounded hover:text-blue-600 hover:cursor-pointer">
                    New Category +
                </a>
            </div>
            <div class="relative">
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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

<!-- Category Modal (Hidden by Default) -->
<div id="categoryModal"
    class="fixed inset-0 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <!-- Category Name -->
            <div>
                <label for="category_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" name="name" id="category_name" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2">
            </div>

            <!-- Modal Buttons -->
            <div class="flex justify-end mt-4">
                <button type="button" id="closeModalBtn"
                    class="px-4 py-2 bg-gray-400 text-white rounded-md mr-2">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Add Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Custom JavaScript for Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const openModalBtn = document.getElementById("openModalBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const modal = document.getElementById("categoryModal");

        // Open modal when clicking "New Category" button
        openModalBtn.addEventListener("click", function() {
            modal.classList.remove("hidden");
        });

        // Close modal when clicking "Cancel" button
        closeModalBtn.addEventListener("click", function() {
            modal.classList.add("hidden");
        });

        // Close modal when clicking outside of it
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });
    });
</script>
@endsection