<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('order', 'product')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        // Récupérez les produits et les clients
        $products = Product::all();
        $customers = Customer::all();

        // Passez les variables à la vue
        return view('sales.create', compact('products', 'customers'));
    }

    // Méthode pour stocker la vente
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $customer = Customer::find($request->customer_id);

        foreach ($request->products as $productData) {
            $product = Product::find($productData['product_id']);

            // Vérifiez la disponibilité du stock
            if ($product->quantity < $productData['quantity']) {
                return redirect()->back()->with('error', 'Insufficient stock for ' . $product->name);
            }

            // Créez la vente
            // La logique pour enregistrer la vente et mettre à jour le stock est à ajouter ici
            $product->quantity -= $productData['quantity'];
            $product->save();
        }

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }

    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        $orders = Order::all();
        $products = Product::all();
        return view('sales.edit', compact('sale', 'orders', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric',
        ]);

        $product = Product::find($request->product_id);

        if ($product->quantity + $sale->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }

        $product->increment('quantity', $sale->quantity);
        $sale->update($request->all());
        $product->decrement('quantity', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $product = Product::find($sale->product_id);
        $product->increment('quantity', $sale->quantity);
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}
