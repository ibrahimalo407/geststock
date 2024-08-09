<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation de l'image
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;

    if ($request->hasFile('image')) {
        $category->image = $request->file('image')->store('categories', 'public'); // Stocker l'image
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category created successfully.');
}

public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation de l'image
    ]);

    $category->name = $request->name;
    $category->description = $request->description;

    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->image = $request->file('image')->store('categories', 'public'); // Stocker la nouvelle image
    }

    $category->save();

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
