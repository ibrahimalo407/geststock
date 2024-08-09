@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Ajouter du stock pour {{ $product->name }}</h2>
            
            <!-- Afficher les messages de succès ou d'erreur -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulaire pour ajouter du stock -->
            <form action="{{ route('products.addStock', $product->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Quantité à ajouter</label>
                    <input type="number" name="quantity" id="quantity" min="1" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 text-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">Ajouter au stock</button>
            </form>
        </div>
    </div>
</div>
@endsection
