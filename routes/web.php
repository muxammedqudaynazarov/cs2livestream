<?php

use App\Http\Controllers\CsDatumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SteamAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/gsi', [CsDatumController::class, 'gsi']);
Route::get('/get/{id}', [CsDatumController::class, 'get']);
Route::get('/score', [CsDatumController::class, 'score_live']);

Route::get('login/steam', [SteamAuthController::class, 'redirectToSteam'])->name('auth.steam');
Route::get('login/steam/callback', [SteamAuthController::class, 'handleSteamCallback']);

Auth::routes();
Route::get('/login', function () {
    return redirect()->route('auth.steam');
})->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
