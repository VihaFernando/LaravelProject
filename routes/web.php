<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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
