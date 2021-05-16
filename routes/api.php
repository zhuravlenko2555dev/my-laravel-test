<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;
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

Route::group(['middleware' => 'throttle:20'], function () {
    Route::resource('episodes', EpisodeController::class)->middleware('auth:sanctum')->only(['index', 'show']);
    Route::get('characters/random', [CharacterController::class, 'random'])->middleware('auth:sanctum');
    Route::resource('characters', CharacterController::class)->middleware('auth:sanctum')->only(['index']);
    Route::get('quotes/random', [QuoteController::class, 'random_by_author'])->middleware('auth:sanctum');
    Route::resource('quotes', QuoteController::class)->middleware('auth:sanctum')->only(['index'])->only(['index']);
});
