<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/orders/po_list/', function () {
    return view('orders_list');
})->middleware(['auth', 'verified'])->name('orders_list');

Route::get('/orders/add_purchase/', function () {
    return view('orders_add_purchase');
})->middleware(['auth', 'verified'])->name('orders_add_purchase');

Route::post('/orders/add_purchase', [App\Http\Controllers\ProductionController::class, 'store'])->name('orders_add_purchase.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


