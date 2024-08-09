<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Sale::sum('amount'); // ou une autre logique pour obtenir la somme des ventes
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();

        // Exemple de vente totale par produit
        $salesByProduct = Sale::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
                              ->groupBy('product_id')
                              ->get()
                              ->mapWithKeys(function ($sale) {
                                  return [$sale->product_id => $sale->total_quantity];
                              });

        return view('dashboard', compact('totalSales', 'totalOrders', 'totalProducts', 'totalCustomers', 'salesByProduct'));
    }
}
