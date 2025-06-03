<?php

//Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
//Route::post('login', [AuthController::class, 'login'])->name('login.post');


use App\Http\Controllers\Crm\DataTableController;
use Illuminate\Support\Facades\Route;

Route::prefix('dt/{table}')->group(function () {
    Route::get('/', [DataTableController::class, 'index'])->name('datatable.index');
    Route::get('config', [DataTableController::class, 'config'])->name('datatable.config');
});
