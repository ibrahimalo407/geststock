@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Order Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <h2 class="text-lg font-bold">Customer:</h2>
            <p>{{ $order->customer->name }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-bold">Total Amount:</h2>
            <p>{{ $order->total_amount }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-bold">Created At:</h2>
            <p>{{ $order->created_at->format('d-m-Y H:i') }}</p>
        </div>

        <a href="{{ route('orders.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Orders</a>
    </div>
</div>
@endsection
