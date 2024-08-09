@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-4">Customers</h1>
        <a href="{{ route('customers.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Customer
        </a>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Phone</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Address</th>
                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-2">{{ $customer->name }}</td>
                            <td class="px-4 py-2">{{ $customer->email }}</td>
                            <td class="px-4 py-2">{{ $customer->phone }}</td>
                            <td class="px-4 py-2">{{ $customer->address }}</td>
                            <td class="px-4 py-2 flex space-x-2 items-center">
                                <a href="{{ route('customers.show', $customer) }}"
                                    class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-eye fa-lg"></i>
                                </a>
                                <a href="{{ route('customers.edit', $customer) }}"
                                    class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fas fa-edit fa-lg"></i>
                                </a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
@endsection
