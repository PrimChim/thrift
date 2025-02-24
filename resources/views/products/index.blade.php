@extends('layouts.admin')

@section('title', 'Products - Thrift')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Product List</h1>
    <a href="{{ route('products.create') }}"
        class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
        Add Product
    </a>
</div>

<!-- Search and Filter Section -->
<div class="mb-6 p-4 bg-gray-50 rounded-lg">
    <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <label for="search" class="block text-gray-700 text-sm font-medium mb-1">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                placeholder="Search by product name"
                class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
        </div>
        <div class="w-full md:w-48">
            <label for="category_id" class="block text-gray-700 text-sm font-medium mb-1">Filter by Category</label>
            <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                <option value="">All categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Apply Filters
            </button>
            @if(request('search') || request('role'))
            <a href="{{ route('users.index') }}" class="ml-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                Clear
            </a>
            @endif
        </div>
    </form>
</div>

@if (session('success'))
<div class="mb-4 p-5 bg-green-300 text-white">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-left">Quantity</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6">{{ $product->id }}</td>
                <td class="py-3 px-6">{{ $product->name }}</td>
                <td class="py-3 px-6">Rs.{{ number_format($product->price, 2) }}</td>
                <td class="py-3 px-6">{{ $product->quantity }}</td>
                <td class="py-3 px-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('products.show', $product->id) }}"
                            class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('products.edit', $product->id) }}"
                            class="text-indigo-500 hover:underline">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $products->appends(request()->query())->links() }}
    </div>

</div>
@endsection