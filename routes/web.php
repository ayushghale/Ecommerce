<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/login', [DashboardController::class, 'login'])->name('admin.login');

Route::post('/login', [DashboardController::class, 'authenticate'])->name('admin.authenticate');


Route::prefix('admin')->middleware("admin.auth")->group(function () {

    // log out
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');


    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard'); // dashboard

    // Users
    Route::get('/users', [UserController::class, 'displayUser'])->name('admin.user.display'); // display all users
    Route::get('/users/add', [UserController::class, 'addUser'])->name('admin.users.add'); // add new user
    Route::get('/users/edit/{id}', [UserController::class, 'editUser'])->name('admin.users.edit'); // edit user
    Route::post('/users/store', [UserController::class, 'storeUser'])->name('admin.users.store');  // store user
    Route::post('/users/update/{id}', [UserController::class, 'updateUser'])->name('admin.users.update'); // update user
    Route::get('/users/delete/{id}', [UserController::class, 'deleteUser'])->name('admin.users.delete'); // delete user

    // Categories
    Route::get('/categories', [CategoryController::class, 'displayCategory'])->name('admin.category.display'); // display all categories
    Route::get('/categories/add', [CategoryController::class, 'addCategory'])->name('admin.categories.add'); // add new category
    Route::get('/categories/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.categories.edit'); // edit category
    Route::post('/categories/store', [CategoryController::class, 'storeCategory'])->name('admin.categories.store'); // store category
    Route::post('/categories/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin.categories.update'); // update category
    Route::get('/categories/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.categories.delete'); // delete category


    // Products
    Route::get('/products', [ProductController::class, 'displayProduct'])->name('admin.product.display'); // display all products
    Route::get('/products/add', [ProductController::class, 'addProduct'])->name('admin.products.add'); // add new product
    Route::get('/products/edit/{id}', [ProductController::class, 'editProduct'])->name('admin.products.edit'); // edit product
    Route::post('/products/store', [ProductController::class, 'storeProduct'])->name('admin.products.store'); // store product
    Route::post('/products/update/{id}', [ProductController::class, 'updateProduct'])->name('admin.products.update'); // update product
    Route::get('/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin.products.delete'); // delete product


    // Orders
    Route::get('/orders/new', [OrderController::class, 'newOrder'])->name('admin.orders.new'); // new order
    Route::get('/orders/completed', [OrderController::class, 'completedOrder'])->name('admin.orders.completed'); // completed order
    Route::post('/orders/update/{id}', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.statusUpdate'); // update order status

    // view order details
    Route::get('/orders/view/{id}', [OrderController::class, 'viewOrder'])->name('admin.orders.view'); // view order details

    // Reports
    Route::get('/reports/sales', [ReportController::class, 'salesReoprt'])->name('admin.reports.sales'); // sales report
    Route::get('/reports/products', [ReportController::class, 'productReoprt'])->name('admin.reports.products'); // product report
    Route::get('/reports/users', [ReportController::class, 'userReoprt'])->name('admin.reports.users'); // user report
    Route::get('/reports/orders', [ReportController::class, 'orderReoprt'])->name('admin.reports.orders'); // order report

});

