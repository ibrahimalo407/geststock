<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories', 'tags')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function showAddStockForm($id)
    {
        $product = Product::findOrFail($id);
        return view('products.add-stock', compact('product'));
    }


    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('products.create', compact('tags', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['tags', 'categories'])->findOrFail($id);

        return view('products.show', compact('product'));
    }


    public function increaseStock(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product->increment('quantity', $request->quantity);

        return redirect()->route('products.index')->with('success', 'Stock increased successfully.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'tags' => 'array',
            'categories' => 'array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        // Create the product
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'image' => $imagePath ? str_replace('public/', '', $imagePath) : null,
        ]);

        // Attach tags and categories
        if ($request->has('tags')) {
            $product->tags()->sync($request->input('tags'));
        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }
    public function edit(Product $product)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'tags', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'tags' => 'nullable|array',
            'categories' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $product->update($request->only('name', 'description', 'price', 'quantity'));

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->update(['image' => $imagePath]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    public function addStock(Request $request, $id)
    {
        $product = Product::find($id);
        $product->quantity += $request->quantity;
        $product->save();

        return redirect()->route('products.show', $id)->with('success', 'Quantité ajoutée avec succès.');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
