<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IngredientController;

// Public Routes (Homepage, Products, About, Contact)
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/products', [PublicController::class, 'products'])->name('products');
Route::get('/products/{id}', [PublicController::class, 'productDetails'])->name('product.details');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

// Staff Authentication Routes
Route::prefix('staff')->group(function () {
    Route::get('/register', [StaffAuthController::class, 'showRegister'])->name('staff.register.show');
    Route::post('/register', [StaffAuthController::class, 'register'])->name('staff.register');
    Route::get('/verify', [StaffAuthController::class, 'showVerify'])->name('staff.verify.show');
    Route::post('/verify', [StaffAuthController::class, 'verify'])->name('staff.verify');
    Route::get('/set-password', [StaffAuthController::class, 'showSetPassword'])->name('staff.setPassword.show');
    Route::post('/set-password', [StaffAuthController::class, 'setPassword'])->name('staff.setPassword');
    Route::get('/login', [StaffAuthController::class, 'showLogin'])->name('staff.login.show');
    Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login');
    Route::post('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');

    // Staff Dashboard & Management (Protected)
    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffDashboard'])->name('staff.dashboard');
        
        // Product Management - Staff and Admin only
        Route::middleware('role:Staff,Admin')->group(function () {
            Route::resource('products', ProductController::class);
        });
        
        // Order Management - All roles can view orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        
        // Ingredient Management - Manager and Admin only
        Route::middleware('role:Manager,Admin')->group(function () {
            Route::resource('ingredients', IngredientController::class);
        });
    });
});

// Customer Authentication Routes
Route::prefix('customer')->group(function () {
    Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register.show');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('customer.register');
    Route::get('/verify', [CustomerAuthController::class, 'showVerify'])->name('customer.verify.show');
    Route::post('/verify', [CustomerAuthController::class, 'verify'])->name('customer.verify');
    Route::get('/set-password', [CustomerAuthController::class, 'showSetPassword'])->name('customer.setPassword.show');
    Route::post('/set-password', [CustomerAuthController::class, 'setPassword'])->name('customer.setPassword');
    Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login.show');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('customer.login');
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

    // Customer Dashboard & Orders (Protected)
    Route::middleware('auth:customer')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'customerDashboard'])->name('customer.dashboard');
        Route::get('/cart', function() { return view('customer.cart'); })->name('customer.cart');
        Route::get('/orders', [DashboardController::class, 'customerOrders'])->name('customer.orders');
        Route::post('/orders', [OrderController::class, 'store'])->name('customer.orders.store');
        Route::get('/orders/success/{id}', [OrderController::class, 'orderSuccess'])->name('customer.order.success');
    });
});
