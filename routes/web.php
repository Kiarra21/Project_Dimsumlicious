<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyProfileController;

// ============================================
// PUBLIC ROUTES - Wajib Login (No Guest Access)
// ============================================

// Homepage
Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// Product catalog for users
Route::get('/products', [HomeController::class, 'products'])
    ->middleware('auth')
    ->name('user.products');

// About & Contact page (combined)
Route::get('/about', [HomeController::class, 'about'])
    ->middleware('auth')
    ->name('user.about');

// Promo page for users
Route::get('/promo', [HomeController::class, 'promo'])
    ->middleware('auth')
    ->name('user.promo');

// ============================================
// USER ROUTES (Authenticated Customer)
// ============================================

// Cart Management
Route::prefix('cart')
    ->middleware(['auth', 'role:user'])
    ->name('cart.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\CartController::class, 'index'])->name('index');
        Route::post('/add/{productId}', [App\Http\Controllers\CartController::class, 'add'])->name('add');
        Route::put('/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('remove');
        Route::delete('/', [App\Http\Controllers\CartController::class, 'clear'])->name('clear');
    });



// Route::post('/checkout/upload-payment', [App\Http\Controllers\CheckoutController::class, 'uploadPayment'])
//     ->middleware(['auth', 'role:user'])
//     ->name('checkout.upload-payment');

// Checkout & Orders
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

    // User's own orders
    Route::get('/my-orders', [App\Http\Controllers\UserOrderController::class, 'index'])->name('user.orders');
    Route::get('/my-orders/{id}', [App\Http\Controllers\UserOrderController::class, 'show'])->name('user.orders.show');

    // Payment proof upload
    Route::post('/orders/{id}/upload-payment', [App\Http\Controllers\UserOrderController::class, 'uploadPayment'])->name('user.orders.upload-payment');
});

// ============================================
// AUTHENTICATION ROUTES
// ============================================

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================
// ADMIN/STAFF ROUTES (Protected)
// ============================================

// Dashboard (Admin & Staff)
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Product Management (Admin & Staff with permissions)
Route::prefix('admin/products')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('products.')
    ->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProductController::class, 'destroy'])
            ->middleware('role:admin')
            ->name('destroy');
    });

// Category Management (Admin & Staff)
Route::prefix('categories')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('categories.')
    ->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])
            ->middleware('role:admin')
            ->name('destroy');
    });

// Order Management (Admin & Staff)
Route::prefix('orders')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('orders.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('show');
        Route::put('/{id}/status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{id}', [App\Http\Controllers\OrderController::class, 'destroy'])
            ->middleware('role:admin')
            ->name('destroy');
    });

// Payment Management (Admin & Staff)
Route::prefix('payments')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('payments.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [App\Http\Controllers\PaymentController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [App\Http\Controllers\PaymentController::class, 'verify'])->name('verify');
        Route::post('/{id}/reject', [App\Http\Controllers\PaymentController::class, 'reject'])->name('reject');
    });


// Staff Management (Admin Only)
Route::prefix('staff')
    ->middleware(['auth', 'role:admin'])
    ->name('staff.')
    ->group(function () {
        Route::get('/', [StaffController::class, 'index'])->name('index');
        Route::post('/', [StaffController::class, 'store'])->name('store');
        Route::put('/{id}', [StaffController::class, 'update'])->name('update');
        Route::delete('/{id}', [StaffController::class, 'destroy'])->name('destroy');
    });

// Reports (Admin Only)
Route::prefix('reports')
    ->middleware(['auth', 'role:admin'])
    ->name('reports.')
    ->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::post('/sales', [ReportController::class, 'generateSales'])->name('sales');
        Route::post('/stock', [ReportController::class, 'generateStock'])->name('stock');
    });

// Promo Management (Admin & Staff)
Route::prefix('promos')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('promos.')
    ->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::post('/', [PromoController::class, 'store'])->name('store');
        Route::put('/{id}', [PromoController::class, 'update'])->name('update');
        Route::delete('/{id}', [PromoController::class, 'destroy'])
            ->middleware('role:admin')
            ->name('destroy'); // Only admin can delete
    });

// Company Profile (Admin Only)
Route::prefix('company-profile')
    ->middleware(['auth', 'role:admin'])
    ->name('company-profile.')
    ->group(function () {
        Route::get('/', [CompanyProfileController::class, 'index'])->name('index');
        Route::put('/', [CompanyProfileController::class, 'update'])->name('update');
    });

// Profile (Admin & Staff)
Route::prefix('profile')
    ->middleware(['auth', 'role:admin,staff'])
    ->name('profile.')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('update-password');
    });
