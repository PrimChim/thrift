<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

Route::get('/', [ProductController::class, 'welcome'])-> name('home');

Route::get('/product/{product}', [ProductController::class, 'show']);

Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::resource('categories', CategoryController::class);

// Protect routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



