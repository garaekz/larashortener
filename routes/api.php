<?php

use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('apps/{app}/token', [AppController::class, 'token'])->name('apps.token');
});

Route::group(
    [
        'middleware' => [
            'auth:sanctum',
            'ability:admin,shorts:view,shorts:create',
        ],
        'prefix' => 'v1',
        'as' => 'api.v1.',
        'namespace' => 'App\Http\Controllers\Api\V1',
    ],
    function () {
        Route::get('shorts/{code}', 'ShortApiController@show')->name('shorts.show');
        Route::post('shorts', 'ShortApiController@store')->name('shorts.store');
    }
);
