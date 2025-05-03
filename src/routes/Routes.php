<?php

namespace src\routes;

use src\controllers\LoginController;
use src\core\Route;

Route::get('/login', LoginController::class, 'index')->name('auth.login');