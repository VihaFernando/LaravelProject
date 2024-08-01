<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

// Redirect unauthenticated users to login or authenticated users to admin dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/admin');
    } else {
        return redirect('/login');
    }
});

// Authentication routes
Auth::routes();

// Home route with authentication middleware
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Admin route with authentication middleware
Route::get('/admin', function () {
    return view('admin');
})->middleware('auth');

// Product routes with authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // List products
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Show form to add new product
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Store new product
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Show form to edit product
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Update product
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy'); // Delete product
});
