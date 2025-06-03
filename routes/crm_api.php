<?php

use App\Http\Controllers\Crm\AuthController;
use App\Http\Controllers\Crm\CategoryController;

include __DIR__ . '/datatable.php';

Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth:api'])->group(function () {
    Route::customResource("categories", CategoryController::class);
});




