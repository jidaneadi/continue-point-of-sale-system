<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhotographerController;
use App\Http\Controllers\PhotoSessionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\ProductDiscountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'master', 'middleware' => ['auth:web', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/{id}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transaction/update/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transaction/{id}/destroy', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    Route::get('/transaction/data', [TransactionController::class, 'data'])->name('transaction.data');

    Route::get('/photo-session', [PhotoSessionController::class, 'index'])->name('photo-session.index');
    Route::get('/photo-session/create', [PhotoSessionController::class, 'create'])->name('photo-session.create');
    Route::post('/photo-session/store', [PhotoSessionController::class, 'store'])->name('photo-session.store');
    Route::get('/photo-session/{id}/edit', [PhotoSessionController::class, 'edit'])->name('photo-session.edit');
    Route::put('/photo-session/update/{id}', [PhotoSessionController::class, 'update'])->name('photo-session.update');
    Route::delete('/photo-session/{id}/destroy', [PhotoSessionController::class, 'destroy'])->name('photo-session.destroy');
    Route::get('/photo-session/data', [PhotoSessionController::class, 'data'])->name('photo-session.data');

    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('product-category.index');
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('product-category.create');
    Route::post('/product-category/store', [ProductCategoryController::class, 'store'])->name('product-category.store');
    Route::get('/product-category/{id}/edit', [ProductCategoryController::class, 'edit'])->name('product-category.edit');
    Route::put('/product-category/update/{id}', [ProductCategoryController::class, 'update'])->name('product-category.update');
    Route::delete('/product-category/{id}/destroy', [ProductCategoryController::class, 'destroy'])->name('product-category.destroy');
    Route::get('/product-category/data', [ProductCategoryController::class, 'data'])->name('product-category.data');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/data', [ProductController::class, 'data'])->name('product.data');

    Route::get('/list', [ListProductController::class, 'index']) ->name('list.index');
    Route::get('/list/detail/{id}', [ListProductController::class, 'show_detail']) ->name('list.show_detail');

    Route::get('/discount', [ProductDiscountController::class, 'index'])->name('discount.index');
    Route::get('/discount/create', [ProductDiscountController::class, 'create'])->name('discount.create');
    Route::post('/discount/store', [ProductDiscountController::class, 'store'])->name('discount.store');
    Route::get('/discount/{id}/edit', [ProductDiscountController::class, 'edit'])->name('discount.edit');
    Route::put('/discount/update/{id}', [ProductDiscountController::class, 'update'])->name('discount.update');
    Route::delete('/discount/{id}/destroy', [ProductDiscountController::class, 'destroy'])->name('discount.destroy');
    Route::get('/discount/data', [ProductDiscountController::class, 'data'])->name('discount.data');

    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
    Route::get('/cashier/create', [CashierController::class, 'create'])->name('cashier.create');
    Route::post('/cashier/store', [CashierController::class, 'store'])->name('cashier.store');
    Route::get('/cashier/{id}/edit', [CashierController::class, 'edit'])->name('cashier.edit');
    Route::put('/cashier/update/{id}', [CashierController::class, 'update'])->name('cashier.update');
    Route::delete('/cashier/{id}/destroy', [CashierController::class, 'destroy'])->name('cashier.destroy');
    Route::get('/cashier/data', [CashierController::class, 'data'])->name('cashier.data');

    Route::get('/photographer', [PhotographerController::class, 'index'])->name('photographer.index');
    Route::get('/photographer/create', [PhotographerController::class, 'create'])->name('photographer.create');
    Route::post('/photographer/store', [PhotographerController::class, 'store'])->name('photographer.store');
    Route::get('/photographer/{id}/edit', [PhotographerController::class, 'edit'])->name('photographer.edit');
    Route::put('/photographer/update/{id}', [PhotographerController::class, 'update'])->name('photographer.update');
    Route::delete('/photographer/{id}/destroy', [PhotographerController::class, 'destroy'])->name('photographer.destroy');
    Route::get('/photographer/data', [PhotographerController::class, 'data'])->name('photographer.data');

    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');

    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/role/data', [RoleController::class, 'data'])->name('role.data');

    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/data', [PermissionController::class, 'data'])->name('permission.data');
});

require __DIR__.'/auth.php';
