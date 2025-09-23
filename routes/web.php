<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductionController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/orders/add_purchase/', function () {
    $products = Product::all();
    return view('orders_add_purchase')->with([
        'products' => $products
    ]);
})->middleware(['auth', 'verified'])->name('orders_add_purchase');

Route::post('/purchase-orders/import', [ProductionController::class, 'import'])->name('purchase-orders.import');

Route::get('/orders/po_list/', [ProductionController::class, 'index'])->name('orders_list');

Route::get('/orders/generate-qr/{id}/{child_id}', [ProductionController::class, 'generateQR']);

Route::get('/orders/single_order/{id}', [ProductionController::class, 'single_order'])->name('single_order');

Route::post('/orders/add_purchase', [ProductionController::class, 'store'])->name('orders_add_purchase.store');

Route::post('/orders/update_eta_ata/', [ProductionController::class, 'update_eta_ata'])->name('update_eta_ata');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


