<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $companies = Company::all();
        $products = Product::all();
        return view('invoices.create', compact('companies', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $invoice = Invoice::create([
            'company_id' => $request->company_id,
            'total_amount' => 0,
            'status' => 'pending',
        ]);

        $totalAmount = 0;

        foreach ($request->products as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $request->quantities[$index];
            $totalAmount += $product->price * $quantity;

            $invoice->products()->attach($product, ['quantity' => $quantity]);
        }

        $invoice->update(['total_amount' => $totalAmount]);

        return redirect()->route('invoices.show', $invoice->id)
        ->with('success', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $companies = Company::all();
        $products = Product::all();
        return view('invoices.edit', compact('invoice', 'companies', 'products'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $invoice->update([
            'company_id' => $request->company_id,
            'total_amount' => 0,
            'status' => $request->status ?? 'pending',
        ]);

        $invoice->products()->detach();
        $totalAmount = 0;

        foreach ($request->products as $index => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $request->quantities[$index];
            $totalAmount += $product->price * $quantity;

            $invoice->products()->attach($product, ['quantity' => $quantity]);
        }

        $invoice->update(['total_amount' => $totalAmount]);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
