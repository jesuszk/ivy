<?php

namespace src\routes;

use src\controllers\ProductController;
use src\controllers\UserController;
use src\core\Route;

Route::get('/', ProductController::class, 'index')->name('home.index');
Route::get('/products', ProductController::class, 'index')->name('products.index');
Route::post('/products/store', ProductController::class, 'store')->name('products.store');
Route::get('/products/edit/{uuid}', ProductController::class, 'edit')->name('products.edit')->whereUuid('uuid');
Route::get('/products/delete/{uuid}', ProductController::class, 'delete')->name('products.delete')->whereUuid('uuid');
Route::post('/products/update/{uuid}', ProductController::class, 'update')->name('products.update')->whereUuid('uuid');



Route::get('/users', UserController::class, 'index')->name('users.index');
Route::post('/users/store', UserController::class, 'store')->name('users.store');
Route::get('/users/edit/{uuid}', UserController::class, 'edit')->name('users.edit')->whereUuid('uuid');
Route::get('/users/delete/{uuid}', UserController::class, 'delete')->name('users.delete')->whereUuid('uuid');
Route::post('/users/update/{uuid}', UserController::class, 'update')->name('users.update')->whereUuid('uuid');
