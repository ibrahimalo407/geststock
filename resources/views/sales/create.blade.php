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

    <h1 class="text-2xl font-semibold mb-4">Create Sale</h1>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
            <select id="customer_id" name="customer_id" class="form-select mt-1 block w-full" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="products" class="block text-sm font-medium text-gray-700">Products</label>
            <div id="products">
                <div class="flex mb-2">
                    <select name="products[0][product_id]" class="form-select mt-1 block w-1/2" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="products[0][quantity]" class="form-input mt-1 block w-1/2 ms-2" min="1" required>
                </div>
            </div>
            <button type="button" id="add-product" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Add Another Product
            </button>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save Sale
        </button>
    </form>
</div>

<script>
    document.getElementById('add-product').addEventListener('click', function () {
        const productsDiv = document.getElementById('products');
        const productCount = productsDiv.children.length;
        const newProductDiv = document.createElement('div');
        newProductDiv.classList.add('flex', 'mb-2');
        newProductDiv.innerHTML = `
            <select name="products[${productCount}][product_id]" class="form-select mt-1 block w-1/2" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                @endforeach
            </select>
            <input type="number" name="products[${productCount}][quantity]" class="form-input mt-1 block w-1/2 ms-2" min="1" required>
        `;
        productsDiv.appendChild(newProductDiv);
    });
</script>
@endsection
