<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// ==================== FRONTEND ROUTES ====================

// Make sure this route exists - it points to home
Route::get('/', [FrontendController::class, 'index'])->name('home');

// Products Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');
});

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
});

// Checkout Routes
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Contact Routes
Route::prefix('contact')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('contact');
    Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
});

// ==================== ADMIN ROUTES ====================

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Admin Authentication Routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Product Management Routes
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [AdminController::class, 'products'])->name('index');
        Route::get('/create', [AdminController::class, 'productCreate'])->name('create');
        Route::post('/store', [AdminController::class, 'productStore'])->name('store');
        Route::get('/edit/{id}', [AdminController::class, 'productEdit'])->name('edit');
        Route::put('/update/{id}', [AdminController::class, 'productUpdate'])->name('update');
        Route::delete('/destroy/{id}', [AdminController::class, 'productDestroy'])->name('destroy');
    });
    
    // Order Management Routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminController::class, 'orders'])->name('index');
        Route::get('/show/{id}', [AdminController::class, 'orderShow'])->name('show');
        Route::put('/update-status/{id}', [AdminController::class, 'orderUpdateStatus'])->name('update-status');
    });
    
    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminController::class, 'users'])->name('index');
        Route::get('/show/{id}', [AdminController::class, 'userShow'])->name('show');
        Route::delete('/destroy/{id}', [AdminController::class, 'userDestroy'])->name('destroy');
    });
    
    // Admin Management Routes
    Route::prefix('admins')->name('admins.')->group(function () {
        Route::get('/', [AdminController::class, 'admins'])->name('index');
        Route::get('/create', [AdminController::class, 'adminCreate'])->name('create');
        Route::post('/store', [AdminController::class, 'adminStore'])->name('store');
        Route::delete('/destroy/{id}', [AdminController::class, 'adminDestroy'])->name('destroy');
    });
    
    // Messages Management Routes
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [AdminController::class, 'messages'])->name('index');
        Route::get('/show/{id}', [AdminController::class, 'messageShow'])->name('show');
        Route::delete('/destroy/{id}', [AdminController::class, 'messageDestroy'])->name('destroy');
    });
});