<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\users\ProfileController;
use App\Http\Controllers\CartController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::get('/', [ProductController::class, 'welcome'])->name('home');

// Product view route for users
Route::get('/product/{product}', [ProductController::class, 'show']);

// Product view route for admin
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Routes for order
Route::post('/buy-now/{id}', [OrderController::class, 'buyNow'])->name('buy.now');
Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('orders.success');

// Protect routes that require authentication
Route::middleware(['auth'])->group(function () {

    Route::resource('orders', OrderController::class);
    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');

    // Routes for cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    // admin access only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/profile', [ProfileController::class, 'profile'])->name('admin.profile');
    });

    // Routes accessible to regular users
    Route::middleware(['role:user'])->group(function () {
        //
    });
});
