<?php

use App\Http\Controllers\Crm\AuthController;
use Illuminate\Support\Facades\Route;

include __DIR__ . '/datatable.php';

Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::middleware(['auth:api'])->group(function () {

});




