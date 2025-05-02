<?php

namespace src\routes;

use src\Controllers\CategoryController;
use src\controllers\ProductController;
use src\core\Route;

Route::get('/', ProductController::class, 'index')->name('home.index');
Route::get('/products', ProductController::class, 'index')->name('products.index');
Route::post('/products/store', ProductController::class, 'store')->name('products.store');
Route::get('/products/edit/{uuid}', ProductController::class, 'edit')->name('products.edit')->whereUuid('uuid');
Route::get('/products/delete/{uuid}', ProductController::class, 'delete')->name('products.delete')->whereUuid('uuid');
Route::post('/products/update/{uuid}', ProductController::class, 'update')->name('products.update')->whereUuid('uuid');

Route::get('/categories', CategoryController::class, 'index')->name('categories.index');
Route::post('/categories/store', CategoryController::class, 'store')->name('categories.store');
Route::get('/categories/edit/{uuid}', CategoryController::class, 'edit')->name('categories.edit')->whereUuid('uuid');
Route::get('/categories/delete/{uuid}', CategoryController::class, 'delete')->name('categories.delete')->whereUuid('uuid');
Route::post('/categories/update/{uuid}', CategoryController::class, 'update')->name('categories.update')->whereUuid('uuid');