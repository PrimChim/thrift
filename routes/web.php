<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::get('/', [ProductController::class, 'welcome'])-> name('home');

// Product view route for users
Route::get('/product/{product}', [ProductController::class, 'show']);

// Product view route for admin
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Routes for order
Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])->name('buy.now');
Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('orders.success');

// Protect routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



