@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Companies</h2>
        <a href="{{ route('companies.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Company</a>
    </div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Name</th>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($companies as $company)
                    <tr>
                        <td class="w-1/3 py-3 px-4">{{ $company->name }}</td>
                        <td class="w-1/3 py-3 px-4">{{ $company->email }}</td>
                        <td class="w-1/3 py-3 px-4">
                            <a href="{{ route('companies.show', $company->id) }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">View</a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
