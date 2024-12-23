<?php

use App\Http\Controllers\AuthManger;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubCategoryController;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Route;


Route::get('/',[ AuthManger::class,'home']) -> name('home');
Route::get('/login',[ AuthManger::class,'login']) -> name('login');
Route::post('/login',[ AuthManger::class,'loginPost']) -> name('login.post');
Route::get('/register', [ AuthManger::class,'register']) ->name('register');
Route::post('/register', [ AuthManger::class,'registerPost']) ->name('register.post');
Route::get('/logout', [ AuthManger::class,'logout']) ->name('logout');
Route::get('/logout', [ AuthManger::class,'logout']) ->name('logout');

Route::group(['middleware' => 'useradmin'], function(){
    
    Route::get('/dashboard', [AuthManger::class,'dashboard'])->name('dashboard');
    Route::get('/product', [ProductController::class,'index'])->name('product');
    Route::get('/product/create', [ProductController::class,'create'])->name('product.create');

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

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users/create', [UserController::class,'store'])->name('users.store');
    Route::get('/users/edit/', [UserController::class,'update'])->name('users.update');

    Route::get('/role', [RoleController::class,'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class,'create'])->name('role.create');
    Route::post('/role/create', [RoleController::class,'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class,'edit'])->name('role.edit'); // GET route for editing
    Route::put('/role/edit/{id}', [RoleController::class,'update'])->name('role.update'); // PUT route for updating
    Route::delete('/role/edit/{id}', [RoleController::class,'destroy'])->name('role.delete');

});
