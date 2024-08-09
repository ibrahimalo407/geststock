<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('webhooks', WebhookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sales', SaleController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/products/{product}/increase-stock', [ProductController::class, 'increaseStock'])->name('products.increase-stock');
    Route::resource('customers', CustomerController::class);
    Route::get('/products/{id}/add-stock', [ProductController::class, 'showAddStockForm'])->name('products.addStockForm');
    Route::post('/products/{id}/add-stock', [ProductController::class, 'addStock'])->name('products.addStock');

    // Sales routes
    Route::resource('sales', SaleController::class);
    Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('sales', [SaleController::class, 'store'])->name('sales.store');

    // Orders routes
    Route::resource('orders', OrderController::class);
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

    // Customers routes
    Route::resource('customers', CustomerController::class);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
