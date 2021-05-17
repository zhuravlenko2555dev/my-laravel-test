<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'throttle:20', 'increment.user']], function () {
    Route::resource('episodes', EpisodeController::class)->only(['index', 'show']);
    Route::get('characters/random', [CharacterController::class, 'random']);
    Route::resource('characters', CharacterController::class)->only(['index']);
    Route::get('quotes/random', [QuoteController::class, 'random_by_author']);
    Route::resource('quotes', QuoteController::class)->only(['index']);
});

Route::get('stats', [StatsController::class, 'stats']);
Route::get('my-stats', [StatsController::class, 'my_stats'])->middleware('auth:sanctum');
