<!-- resources/views/categories/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Add New Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <!-- Category Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Category Image</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</button>
    </form>
</div>
@endsection
