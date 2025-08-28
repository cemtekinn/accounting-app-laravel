<?php

use App\Http\Controllers\Dash\AuthController;
use App\Http\Controllers\Dash\CategoryController;
use App\Http\Controllers\Dash\CustomerController;
use App\Http\Controllers\Dash\NoteController;
use App\Http\Controllers\Dash\ProductController;
use App\Http\Controllers\Dash\SupplierController;
use App\Http\Controllers\Dash\TransactionController;
use App\Http\Controllers\Dash\UnitController;


Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});


Route::middleware(['auth:api'])->group(function () {
    Route::customResource("categories", CategoryController::class);
    Route::customResource("products", ProductController::class);
    Route::customResource("units", UnitController::class);
    Route::customResource("notes", NoteController::class);
    Route::customResource("transactions", TransactionController::class);

    Route::customResource("customers", CustomerController::class, [
        '{customer}' => [
            'add-note' => 'post',
            'notes' => 'get'
        ]]);

    Route::customResource("suppliers", SupplierController::class, [
        '{supplier}' => [
            'add-contact' => 'post',
            'add-note' => 'post',
            'notes' => 'get'
        ]]);
});




