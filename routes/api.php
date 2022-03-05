<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{QuoteController, CategoryController};

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::resources([
        'category' => CategoryController::class,
        'quote' => QuoteController::class
    ]);

    // // quote by uuid
    // Route::get('quote/quote/{quote}', [\App\Http\Controllers\API\QuoteController::class, 'show']);

    // // random quote
    // Route::get('quote/random', [\App\Http\Controllers\API\QuoteController::class, 'random']);

    // // quote of the day
    // Route::get('quote/today', [\App\Http\Controllers\API\QuoteController::class, 'qod']);
});

