<?php

use App\Http\Controllers\CsDatumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gsi', [CsDatumController::class, 'gsi']);
