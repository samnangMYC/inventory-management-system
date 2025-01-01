<?php

use App\Http\Controllers\AuthManger;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleListController;
use Illuminate\Support\Facades\Route;


Route::get('/',[ AuthManger::class,'home']) -> name('home');
Route::get('/login',[ AuthManger::class,'login']) -> name('login');
Route::post('/login',[ AuthManger::class,'loginPost']) -> name('login.post');



Route::group(['middleware' => 'useradmin'], function(){
    Route::get('/register', [ AuthManger::class,'register']) ->name('register');
    Route::post('/register', [ AuthManger::class,'registerPost']) ->name('register.post');
    Route::get('/logout', [ AuthManger::class,'logout']) ->name('logout');
    Route::get('/logout', [ AuthManger::class,'logout']) ->name('logout');
    
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/product', [ProductController::class,'index'])->name('product');
    Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class,'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    
    Route::get('/product-brand', [ProductBrandController::class,'index'])->name('product-brand.index');
    Route::get('/product-brand/create', [ProductBrandController::class,'create'])->name('product-brand.create');
    Route::post('/product-brand/create', [ProductBrandController::class,'store'])->name('product-brand.store');
    Route::get('/product-brand/edit/{id}', [ProductBrandController::class,'edit'])->name('product-brand.edit');
    Route::put('/product-brand/edit/{id}', [ProductBrandController::class,'update'])->name('product-brand.update');
    Route::delete('/product-brand/{id}', [ProductBrandController::class,'destroy'])->name('product-brand.destroy');
    


   
    // Define resource routes for categories
    // Route::resource('categories', CategoryController::class);
    Route::get('/categories', [CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class,'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

   
    Route::get('/sub-category', [SubCategoryController::class,'index'])->name('sub-category.index');
    Route::get('/sub-category/create', [SubCategoryController::class,'create'])->name('sub-category.create');
    Route::post('/sub-category/create', [SubCategoryController::class,'store'])->name('sub-category.store');
    Route::get('/sub-category/edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
    Route::put('/sub-category/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
    Route::delete('/sub-category/{id}', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');

    Route::get('/sales', [SaleController::class,'index'])->name(name: 'sale.index');
    Route::post('/sales/create', [SaleController::class,'store'])->name(name: 'sale.store');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/sale-list', [SaleListController::class,'index'])->name(name: 'sale-list.index');
    

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users/create', [UserController::class,'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class,'edit'])->name('users.edit');
    Route::put('/users/edit/{id}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/edit/{id}', [UserController::class,'destroy'])->name('users.destroy');

    Route::get('/role', [RoleController::class,'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class,'create'])->name('role.create');
    Route::post('/role/create', [RoleController::class,'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class,'edit'])->name('role.edit'); // GET route for editing
    Route::put('/role/edit/{id}', [RoleController::class,'update'])->name('role.update'); // PUT route for updating
    Route::delete('/role/edit/{id}', [RoleController::class,'destroy'])->name('role.delete');

});
