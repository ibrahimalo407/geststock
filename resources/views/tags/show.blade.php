<!-- resources/views/tags/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $tag->name }}</h1>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <p class="text-gray-800 mb-4">{{ $tag->description }}</p>
            <a href="{{ route('tags.edit', $tag->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Edit Tag</a>
        </div>
    </div>
</div>
@endsection
