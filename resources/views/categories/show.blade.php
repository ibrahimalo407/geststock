<!-- resources/views/categories/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $category->name }}</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        @if ($category->image)
            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-500">No Image</span>
            </div>
        @endif
        <div class="p-6">
            <p class="text-gray-800 mb-4">{{ $category->description }}</p>
            <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Edit Category</a>
        </div>
    </div>
</div>
@endsection
