<!-- resources/views/tags/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-4">Tags</h1>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Add New Tag</a>
        <form action="{{ route('tags.index') }}" method="GET" class="flex items-center space-x-2">
            <input type="text" name="search" placeholder="Search..." class="border rounded px-3 py-2" value="{{ request('search') }}">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition">Search</button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($tags as $tag)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 6.4c-1.9 0-3.4 1.5-3.4 3.4 0 1.9 1.5 3.4 3.4 3.4s3.4-1.5 3.4-3.4-1.5-3.4-3.4-3.4zm0 5.6c-1.2 0-2.2-1-2.2-2.2 0-1.2 1-2.2 2.2-2.2s2.2 1 2.2 2.2c0 1.2-1 2.2-2.2 2.2zM19.1 13.2l-2.1-2.1 2.1-2.1c.5-.5.5-1.3 0-1.8-.5-.5-1.3-.5-1.8 0l-2.1 2.1-2.1-2.1c-.5-.5-1.3-.5-1.8 0-.5.5-.5 1.3 0 1.8l2.1 2.1-2.1 2.1c-.5.5-.5 1.3 0 1.8.5.5 1.3.5 1.8 0l2.1-2.1 2.1 2.1c.5.5 1.3.5 1.8 0 .5-.5.5-1.3 0-1.8z"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $tag->name }}</h2>
                    <p class="text-gray-600 mt-1">{{ Str::limit($tag->description, 100) }}</p>
                </div>
                <div class="flex space-x-4 ml-auto">
                    <a href="{{ route('tags.show', $tag->id) }}" class="text-blue-500 hover:text-blue-700">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 4.3a7.7 7.7 0 1 0 0 15.4A7.7 7.7 0 0 0 12 4.3zM12 18a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm4.5-7.5a.75.75 0 0 1-.75-.75V6a.75.75 0 0 1 1.5 0v3.75a.75.75 0 0 1-.75.75z"/>
                        </svg>
                    </a>
                    <a href="{{ route('tags.edit', $tag->id) }}" class="text-gray-800 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.71 5.29a1 1 0 0 0-1.42 0L15 8.59l-2.88-2.88a1 1 0 0 0-1.42 1.42l2.88 2.88-1.96 1.96a1 1 0 0 0-.29.71V16a1 1 0 0 0 1 1h3a1 1 0 0 0 .71-.29l1.96-1.96 2.88 2.88a1 1 0 0 0 1.42-1.42l-2.88-2.88 2.88-2.88a1 1 0 0 0 0-1.42z"/>
                        </svg>
                    </a>
                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 2H8c-1.1 0-2 .9-2 2v2H2v2h2l1 14h12l1-14h2V4h-2V2zm-6 2h4v2h-4V4zm-2 16l-1-12h10l-1 12H8z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $tags->links() }}
    </div>
</div>
@endsection
    