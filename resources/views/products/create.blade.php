@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Add New Product</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 space-y-6">
        @csrf

        <!-- Product Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name') }}" required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description') }}</textarea>
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('price') }}" required>
        </div>

        <!-- Quantity -->
        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('quantity') }}" required>
        </div>

        <!-- Tags -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div class="flex flex-wrap">
                @foreach($tags as $tag)
                <div class="mr-4">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}" class="mr-2">
                    <label for="tag{{ $tag->id }}" class="text-sm">{{ $tag->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Categories -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Categories</label>
            <div class="flex flex-wrap">
                @foreach($categories as $category)
                <div class="mr-4">
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category{{ $category->id }}" class="mr-2">
                    <label for="category{{ $category->id }}" class="text-sm">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Product Image</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Product</button>
    </form>
</div>
@endsection
