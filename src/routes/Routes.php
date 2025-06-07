<?php

namespace src\routes;
;

use src\controllers\LoginController;
use src\controllers\RegisterController;
use src\core\Route;

Route::get('/login', LoginController::class, 'form')->name('auth.login');
Route::get('/register', RegisterController::class, 'form')->name('auth.register');
Route::post('/register/store', RegisterController::class, 'store')->name('auth.register.store');