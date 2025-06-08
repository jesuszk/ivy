<?php

namespace src\routes;
;

use src\controllers\AppController;
use src\controllers\LoginController;
use src\controllers\RegisterController;
use src\core\Route;

Route::get('/login', LoginController::class, 'form')->name('auth.login');
Route::post('/login/store', LoginController::class, 'login')->name('auth.login.store');

Route::get('/register', RegisterController::class, 'form')->name('auth.register');
Route::post('/register/store', RegisterController::class, 'createUser')->name('auth.register.store');


Route::get('/app', AppController::class, "home")->name("panel.home");
Route::get('/logout', LoginController::class, 'logout')->name("auth.logout");