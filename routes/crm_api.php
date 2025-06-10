<?php

use App\Http\Controllers\Crm\AuthController;
use App\Http\Controllers\Crm\CategoryController;
use App\Http\Controllers\Crm\CustomerController;
use App\Http\Controllers\Crm\NoteController;
use App\Http\Controllers\Crm\ProductController;
use App\Http\Controllers\Crm\SupplierController;
use App\Http\Controllers\Crm\UnitController;

include __DIR__ . '/datatable.php';

Route::prefix('auth')->as('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});


Route::middleware(['auth:api'])->group(function () {
    Route::customResource("categories", CategoryController::class);
    Route::customResource("products", ProductController::class);
    Route::customResource("units", UnitController::class);
    Route::customResource("notes", NoteController::class);

    Route::customResource("customers", CustomerController::class, [
        '{customer}' => [
            'add-note' => 'post'
        ]]);

    Route::customResource("suppliers", SupplierController::class, [
        '{supplier}' => [
            'add-contact' => 'post',
            'add-note' => 'post'
        ]]);
});




