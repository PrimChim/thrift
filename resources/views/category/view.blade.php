@extends('layouts.admin')

@section('title', $category->name . ' - Thrift Store')

@section('content')
<h2 class="text-2xl font-bold mb-6">{{ $category->name }}</h2>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @if($category)
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold mt-4">{{ $category->name }}</h3>
        <div class="flex items-center justify-center space-x-4">
            <a href="{{ route('categories.edit', $category->id) }}"
                class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-400">
                Edit
            </a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection