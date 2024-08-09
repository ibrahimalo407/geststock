@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Customer Details</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <strong>Name:</strong> {{ $customer->name }}
        </div>
        <div class="mb-4">
            <strong>Email:</strong> {{ $customer->email }}
        </div>
        <div class="mb-4">
            <strong>Phone:</strong> {{ $customer->phone }}
        </div>
        <div class="mb-4">
            <strong>Address:</strong> {{ $customer->address }}
        </div>

        <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to List</a>
    </div>
</div>
@endsection
