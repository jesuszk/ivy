<?php

namespace src\routes;

use src\controllers\shared\MenuController;
use src\controllers\shared\ProcessController;
use src\controllers\shared\SalesAligmentController;
use src\controllers\shared\UploadsController;
use src\core\Route;

Route::get('/', MenuController::class, 'render')->name('menu.root');
Route::get('/menu', MenuController::class, 'render')->name('menu');
Route::get('/process/open', ProcessController::class, 'open')->name('process.open');

Route::post('/uploads/save', UploadsController::class, 'save')->name('uploads.save');
Route::post('/uploads/update', UploadsController::class, 'update')->name('uploads.update');




Route::get('/sales/alignment/list', SalesAligmentController::class, 'list')->name('sales.alignment.list');
Route::get('/sales/alignment/showing/{uuid}', SalesAligmentController::class, 'showing')->whereUuid(['uuid'])->name('sales.alignment.showing');
Route::post('/sales/alignment/persist', SalesAligmentController::class, 'persist')->name('sales.alignment.persist');
