<?php

use App\Http\Controllers\CsDatumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SteamAuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserTeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/gsi', [CsDatumController::class, 'gsi']);
Route::get('/get/{id}', [CsDatumController::class, 'get']);
Route::get('/player/{id}', [CsDatumController::class, 'get'])->name('player');
Route::get('/score', [CsDatumController::class, 'score_live']);
Route::get('/setka', [CsDatumController::class, 'setka']);

Route::get('login/steam', [SteamAuthController::class, 'redirectToSteam'])->name('auth.steam');
Route::get('login/steam/callback', [SteamAuthController::class, 'handleSteamCallback']);

Auth::routes();
Route::get('/login', function () {
    return redirect()->route('auth.steam');
})->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('teams', TeamController::class);
Route::patch('/teams/{team}/regenerate-url', [TeamController::class, 'regenerateUrl'])->name('teams.regenerate_join_url');
Route::get('/join/{token}', [TeamController::class, 'joinTeam'])->name('teams.join')->middleware('auth');
Route::post('/join/{token}', [TeamController::class, 'joinTeamPost'])->name('teams.join.post')->middleware('auth');
Route::get('/pick', [HomeController::class, 'pick']);

Route::prefix('teams/{team}')->name('team.')->group(function () {
    Route::patch('/players/{player}/captain', [UserTeamController::class, 'makeCaptain'])->name('make_captain');
    Route::patch('/players/{player}/accept', [UserTeamController::class, 'acceptPlayer'])->name('accept_player');
    Route::delete('/players/{player}/reject', [UserTeamController::class, 'rejectPlayer'])->name('reject_player');
    Route::post('/players/{player}/transfer', [UserTeamController::class, 'transferPlayer'])->name('transfer_player');
});

Route::get('/match/{id}/veto', [MapController::class, 'index']);
Route::post('/match/{id}/veto/action', [MapController::class, 'action']);
Route::post('/match/{id}/veto/auto', [MapController::class, 'autoAction']);
