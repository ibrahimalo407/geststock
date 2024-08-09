@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Sales</h1>
    <a href="{{ route('sales.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Sale
    </a>

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Order</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Product</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Quantity</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Unit Price</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Total Price</th>
                    <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr class="border-b border-gray-200">
                    <td class="px-4 py-2">{{ $sale->order->id }}</td>
                    <td class="px-4 py-2">{{ $sale->product->name }}</td>
                    <td class="px-4 py-2">{{ $sale->quantity }}</td>
                    <td class="px-4 py-2">{{ $sale->unit_price }}</td>
                    <td class="px-4 py-2">{{ $sale->quantity * $sale->unit_price }}</td>
                    <td class="px-4 py-2 flex space-x-2 items-center">
                        <a href="{{ route('sales.show', $sale) }}" class="text-blue-500 hover:text-blue-600">
                            <i class="fas fa-eye fa-lg"></i>
                        </a>
                        <a href="{{ route('sales.edit', $sale) }}" class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <form action="{{ route('sales.destroy', $sale) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sale?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                <i class="fas fa-trash fa-lg"></i>
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
