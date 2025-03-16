<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;

Route::get('admin', function () {
    return view('layouts.admin');
});

// Routes for Product Management
Route::get('admin/products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('admin/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Routes for Categories Management
Route::get('admin/categories/index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('admin/categories/destroy/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Front Page Routes
Route::get('/', [FrontController::class, 'index'])->name('home.index');
