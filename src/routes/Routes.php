<?php

namespace src\routes;

use src\controllers\CategoryController;
use src\controllers\ProductController;
use src\core\Route;

Route::get('/products', ProductController::class, 'index')->name('products.list');
Route::get('/products/create', ProductController::class, 'create')->name('products.create');
Route::get("/products/details/{uuid}", ProductController::class, "details")
    ->name("products.details")
    ->where(["uuid" => "uuid"]);
Route::post('/products/update', ProductController::class, 'update')->name('products.update');
Route::get('/products/deactivate/{uuid}', ProductController::class, 'deactivate')->name('products.deactivate')->where(["uuid" => "uuid"]);
Route::get('/products/activate/{uuid}', ProductController::class, 'activate')->name('products.activate')->where(["uuid" => "uuid"]);



Route::get('/categories', CategoryController::class, 'list')->name('categories.list');
Route::get('/categories/create', CategoryController::class, 'create')->name('categories.create');
Route::get('/categories/details/{uuid}', CategoryController::class, 'details')->name('categories.details')->whereUuid(["uuid"]);
Route::post('/categories/update', CategoryController::class, 'update')->name('categories.update');
Route::get('/categories/deactivate/{uuid}', CategoryController::class, 'deactivate')->name('categories.deactivate')->where(["uuid" => "uuid"]);
Route::get('/categories/activate/{uuid}', CategoryController::class, 'activate')->name('categories.activate')->where(["uuid" => "uuid"]);
Route::get('/categories/delete/{uuid}', CategoryController::class, 'delete')->name('categories.delete')->whereUuid(["uuid"]);
