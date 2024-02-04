<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ShortController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(
    [
        'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified'],
        'prefix' => 'u'
    ], function () {
        Route::controller(NavigationController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
        });

        Route::apiResource('apps', AppController::class);
        Route::apiResource('shorts', ShortController::class);
    });