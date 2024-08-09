@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Edit Sale</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.update', $sale) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="order_id" class="block text-gray-700 text-sm font-bold mb-2">Order:</label>
            <select name="order_id" id="order_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $sale->order_id == $order->id ? 'selected' : '' }}>{{ $order->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
            <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $sale->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="{{ $sale->quantity }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="mb-4">
            <label for="unit_price" class="block text-gray-700 text-sm font-bold mb-2">Unit Price:</label>
            <input type="number" name="unit_price" id="unit_price" step="0.01" value="{{ $sale->unit_price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
        </div>
    </form>
</div>
@endsection
