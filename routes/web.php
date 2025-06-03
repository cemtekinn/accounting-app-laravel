<?php

use Illuminate\Support\Facades\Route;


Route::view('crm/{any?}', 'crm')->where('any', '.*')->name('crm');
Route::view('{any?}', 'welcome')->where('any', '.*');
