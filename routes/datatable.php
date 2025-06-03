<?php

//Datatable routes
use App\Http\Controllers\Crm\DataTableController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('dt/{table}')->group(function () {
    Route::get('/', [DataTableController::class, 'index'])->name('datatable.index');
    Route::get('/config', [DataTableController::class, 'config'])->name('datatable.config');
});

