@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Company Details</h2>
        <a href="{{ route('companies.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Back</a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Name:</h3>
            <p class="text-gray-600">{{ $company->name }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Address:</h3>
            <p class="text-gray-600">{{ $company->address }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Phone:</h3>
            <p class="text-gray-600">{{ $company->phone }}</p>
        </div>
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Email:</h3>
            <p class="text-gray-600">{{ $company->email }}</p>
        </div>
    </div>
</div>
@endsection
