<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('orders.create', compact('customers','products'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Créer une nouvelle commande
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->total_amount = 0; // Initialiser le montant total
        $order->save();

        // Vérifier si des produits sont inclus dans la requête
        if ($request->has('products') && is_array($request->products)) {
            foreach ($request->products as $productData) {
                $product = Product::find($productData['product_id']);

                if (!$product) {
                    return redirect()->back()->with('error', 'Product not found.');
                }

                if ($product->quantity < $productData['quantity']) {
                    return redirect()->back()->with('error', 'Insufficient stock for ' . $product->name);
                }

                // Réduire le stock
                $product->quantity -= $productData['quantity'];
                $product->save();

                // Ajouter les produits à la commande
                $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
                
                // Calculer le montant total
                $order->total_amount += $product->price * $productData['quantity'];
            }
        }

        // Mettre à jour le montant total de la commande
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }


    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', compact('order', 'customers'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric',
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
