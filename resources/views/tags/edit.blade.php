<!-- resources/views/tags/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Edit Tag</h1>

    <form action="{{ route('tags.update', $tag->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Tag Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('name', $tag->name) }}" required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $tag->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update Tag</button>
    </form>
</div>
@endsection
