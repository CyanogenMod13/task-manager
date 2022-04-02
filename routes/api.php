<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProjectController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::get('/me', 'me');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('/project')->group(function () {
        Route::post('/create', [ProjectController::class, 'create']);
        Route::get('/{id}', [ProjectController::class, 'get'])->whereNumber('id');
        Route::get('/', [ProjectController::class, 'getAll']);
        Route::put('/{id}', [ProjectController::class, 'update'])->whereNumber('id');
        Route::delete('/{id}', [ProjectController::class, 'delete'])->whereNumber('id');
        Route::post('/assign', [ProjectController::class, 'assignUser']);
    });
});
