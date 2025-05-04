<?php

namespace src\routes;

use src\controllers\LoginController;
use src\controllers\RegisterController;
use src\core\Route;

Route::get('/login', LoginController::class, 'index')->name('auth.login');
Route::get('/register', RegisterController::class, 'index')->name('auth.register');
Route::post('/register', RegisterController::class, 'store')->name('auth.registerStore');