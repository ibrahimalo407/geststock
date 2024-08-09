<!-- resources/views/categories/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Categories</h1>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add New Category</a>
        <form action="{{ route('categories.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" placeholder="Search..." class="border rounded px-3 py-2" value="{{ request('search') }}">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition">Search</button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            @if ($category->image)
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-40 object-cover">
            @else
                <div class="w-full h-40 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
            <div class="p-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                <p class="text-gray-600 mt-2">{{ Str::limit($category->description, 100) }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-blue-500 hover:underline">View Details</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="text-gray-800 hover:underline">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
