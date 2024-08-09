@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Invoice</h2>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="company_id" class="block text-gray-700 text-sm font-bold mb-2">Company:</label>
            <select name="company_id" id="company_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="products" class="block text-gray-700 text-sm font-bold mb-2">Products:</label>
            <div id="product-list">
                <div class="flex mb-2">
                    <select name="products[]" class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="quantities[]" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2" placeholder="Quantity" required>
                </div>
            </div>
            <button type="button" id="add-product" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Another Product</button>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Invoice</button>
            <a href="{{ route('invoices.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Cancel</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('add-product').addEventListener('click', function() {
        var productSelect = document.querySelector('select[name="products[]"]').cloneNode(true);
        var quantityInput = document.querySelector('input[name="quantities[]"]').cloneNode(true);
        quantityInput.value = '';

        var productRow = document.createElement('div');
        productRow.classList.add('flex', 'mb-2');
        productRow.appendChild(productSelect);
        productRow.appendChild(quantityInput);

        document.getElementById('product-list').appendChild(productRow);
    });
</script>
@endsection
