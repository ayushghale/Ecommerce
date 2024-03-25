<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\auth\LoginRegisterController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});


Route::post('/login', [LoginRegisterController::class, 'userLogin'])->name('user.index'); // Display all users


// User routes
Route::prefix('user')->group(function () {
    Route::get('/alluser', [UserController::class, 'userData'])->name('user.index'); // Display all users
    Route::get('/{id}', [UserController::class, 'showUserById'])->name('user.showUserById'); // Display user by their id
    Route::post('/create', [UserController::class, 'store'])->name('user.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy'); // Remove the specified resource from storage
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/alladmin', [AdminController::class, 'adminData'])->name('admin.index'); // Display all admins
    Route::get('/{id}', [AdminController::class, 'showAdminById'])->name('admin.showAdminById'); // Display admin by their id
    Route::post('/create', [AdminController::class, 'store'])->name('admin.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); // Remove the specified resource from storage
});

// Category routes
Route::prefix('category')->group(function () {
    Route::get('/allcategory', [CategoryController::class, 'categoryData'])->name('category.index'); // Display all categories
    Route::post('/create', [CategoryController::class, 'store'])->name('category.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Remove the specified resource from storage
    Route::get('/{id}', [CategoryController::class, 'showCategoryById'])->name('category.showCategoryById'); // Display category by their id
});

// Product routes
Route::prefix('product')->group(function () {
    Route::get('/allproduct', [ProductController::class, 'productData'])->name('product.index'); // Display all products
    Route::post('/create', [ProductController::class, 'store'])->name('product.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy'); // Remove the specified resource from storage
    Route::get('/{id}', [ProductController::class, 'showProductById'])->name('product.showProductById'); // Display product by their id
});

// Order routes
Route::prefix('order')->group(function () {
    Route::get('/allorder', [OrderController::class, 'orderData'])->name('order.index'); // Display all orders
    Route::get('/{id}', [OrderController::class, 'showOrderById'])->name('order.showOrderById'); // Display order by their id
    Route::post('/create', [OrderController::class, 'store'])->name('order.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [OrderController::class, 'update'])->name('order.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [OrderController::class, 'destroy'])->name('order.destroy'); // Remove the specified resource from storage
});

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/allcart', [CartController::class, 'cartData'])->name('cart.index'); // Display all carts
    Route::get('/{id}', [CartController::class, 'showCartById'])->name('cart.showCartById'); // Display cart by their id
    Route::post('/create', [CartController::class, 'store'])->name('cart.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy'); // Remove the specified resource from storage
});

// Payment routes
Route::prefix('payment')->group(function () {
    Route::get('/allpayment', [PaymentController::class, 'paymentData'])->name('payment.index'); // Display all payments
    Route::get('/{id}', [PaymentController::class, 'showPaymentById'])->name('payment.showPaymentById'); // Display payment by their id
    Route::post('/create', [PaymentController::class, 'store'])->name('payment.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [PaymentController::class, 'update'])->name('payment.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy'); // Remove the specified resource from storage
});

// Review routes
Route::prefix('review')->group(function () {
    Route::get('/allreview', [ReviewController::class, 'reviewData'])->name('review.index'); // Display all reviews
    Route::get('/{id}', [ReviewController::class, 'showReviewById'])->name('review.showReviewById'); // Display review by their id
    Route::post('/create', [ReviewController::class, 'store'])->name('review.create'); // Store a newly created resource in storage
    Route::post('/update/{id}', [ReviewController::class, 'update'])->name('review.update'); // Update the specified resource in storage
    Route::get('/delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy'); // Remove the specified resource from storage
});




