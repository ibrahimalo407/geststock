@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Sale Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <h2 class="text-lg font-bold">Order:</h2>
            <p>{{ $sale->order->id }}</p>
        </div>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Product:</h2>
            <p>{{ $sale->product->name }}</p>
        </div>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Quantity:</h2>
            <p>{{ $sale->quantity }}</p>
        </div>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Unit Price:</h2>
            <p>{{ $sale->unit_price }}</p>
        </div>
        
        <div class="mb-4">
            <h2 class="text-lg font-bold">Total Price:</h2>
            <p>{{ $sale->quantity * $sale->unit_price }}</p>
        </div>

        <a href="{{ route('sales.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Sales</a>
    </div>
</div>
@endsection
