@extends('layouts.admin')

@section('title', 'Categories - Thrift')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Categories List</h1>
    <a href="{{ route('categories.create') }}"
        class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
        Add Category
    </a>
</div>

@if (session('success'))
<div class="mb-4 text-green-600">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @forelse ($categories as $category)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6">{{ $category->id }}</td>
                <td class="py-3 px-6">{{ $category->name }}</td>
                <td class="py-3 px-6">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('categories.show', $category->id) }}"
                            class="text-blue-500 hover:underline">View</a>
                        <a href="{{ route('categories.edit', $category->id) }}"
                            class="text-indigo-500 hover:underline">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">No categories$categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection