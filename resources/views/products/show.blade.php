@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
            <a href="{{ route('products.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-700 text-white px-5 py-2 rounded-full hover:from-blue-600 hover:to-blue-800 transition-all duration-300 ease-in-out shadow-lg">Back to Products</a>
        </div>

        <!-- Product Image -->
        <div class="flex justify-center mb-8">
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-80 h-80 object-cover rounded-lg shadow-xl">
        </div>

        <!-- Product Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Description:</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Price:</h3>
                <p class="text-gray-700 leading-relaxed">${{ number_format($product->price, 2) }}</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Quantity in Stock:</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->quantity }}</p>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">SKU:</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->sku }}</p>
            </div>
        </div>

        <!-- Categories -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Categories:</h3>
            <div class="flex flex-wrap mt-2">
                @if($product->categories && $product->categories->count() > 0)
                    @foreach($product->categories as $category)
                        <span class="bg-green-100 text-green-700 text-sm font-semibold mr-2 mb-2 px-3 py-1 rounded-full shadow-sm">{{ $category->name }}</span>
                    @endforeach
                @else
                    <p class="text-gray-500">No categories available</p>
                @endif
            </div>
        </div>

        <!-- Tags -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Tags:</h3>
            <div class="flex flex-wrap mt-2">
                @if($product->tags && $product->tags->count() > 0)
                    @foreach($product->tags as $tag)
                        <span class="bg-blue-100 text-blue-700 text-sm font-semibold mr-2 mb-2 px-3 py-1 rounded-full shadow-sm">{{ $tag->name }}</span>
                    @endforeach
                @else
                    <p class="text-gray-500">No tags available</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
