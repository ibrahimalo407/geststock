@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <h1 class="text-2xl font-semibold mb-4">Products</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Product
    </a>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Image</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">SKU</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Price</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Quantity</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded-lg">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $product->name }}</td>
                    <td class="px-4 py-2">{{ $product->sku }}</td>
                    <td class="px-4 py-2">{{ $product->price }}</td>
                    <td class="px-4 py-2">{{ $product->quantity }}</td>
                    <td class="px-4 py-2 flex space-x-2 items-center">
                        <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:text-blue-600 p-2 rounded hover:bg-blue-100 transition">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:text-yellow-600 p-2 rounded hover:bg-yellow-100 transition">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="{{ route('products.addStockForm', $product->id) }}" class="text-green-500 hover:text-green-600 p-2 rounded hover:bg-green-100 transition">
                            <i class="fas fa-plus"></i> Ajouter au stock
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 p-2 rounded hover:bg-red-100 transition">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
