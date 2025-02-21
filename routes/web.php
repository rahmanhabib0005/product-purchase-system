<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->as('admin.')->group(function () {
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->names('product');
    Route::resource('suppliers', App\Http\Controllers\Admin\SupplierController::class)->names('supplier');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->names('order');

    Route::get('/getPurchaseProducts/{order}', [App\Http\Controllers\Admin\OrderController::class, 'getPurchaseProduct'])->name('getPurchaseProducts');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
