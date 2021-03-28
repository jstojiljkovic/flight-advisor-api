<?php

use App\Http\Controllers\Api\V1\AirportController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\FlightController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\RouteController;
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

Route::apiResource('register', RegisterController::class)->only([ 'store' ]);

Route::group([ 'middleware' => [ 'auth.basic.once', 'role:admin' ] ], function () {
    Route::post('cities', [ CityController::class, 'store' ])->name('cities.store');
    Route::post('airports/import', [ AirportController::class, 'import' ])->name('airports.import');
    Route::post('routes/import', [ RouteController::class, 'import' ])->name('routes.import');
});

Route::group([ 'middleware' => [ 'auth.basic.once' ] ], function () {
    Route::prefix('/cities')->name('cities.')->group(function () {
        Route::post('{id}/comments', [ CityController::class, 'storeComment' ])->name('storeComment');
        Route::get('/', [ CityController::class, 'index' ])->name('index');
        Route::get('/search', [ CityController::class, 'search' ])->name('search');
    });
    
    Route::apiResource('comments', CommentController::class)->only([ 'update', 'destroy' ]);
    
    Route::get('flights/cheapest', [ FlightController::class, 'cheapest' ])->name('flights.cheapest');
});
