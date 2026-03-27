<?php

use App\Http\Controllers\CsDatumController;
use App\Http\Controllers\SteamAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/gsi', [CsDatumController::class, 'gsi']);
Route::get('/get/{id}', [CsDatumController::class, 'get']);
Route::get('/score', [CsDatumController::class, 'score_live']);

Route::get('auth/steam', [SteamAuthController::class, 'redirectToSteam'])->name('auth.steam');
Route::get('auth/steam/callback', [SteamAuthController::class, 'handleSteamCallback']);
