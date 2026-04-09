<?php

use App\Http\Controllers\CsDatumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::post('/livestream/gsi', [CsDatumController::class, 'livestream']);
