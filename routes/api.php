<?php

use App\Http\Controllers\Api\AssignUserController;
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
    Route::prefix('/projects')->group(function () {
        Route::post('/create', [ProjectController::class, 'create']);
        Route::get('/{project}', [ProjectController::class, 'show'])->whereNumber('project');
        Route::get('/', [ProjectController::class, 'index']);
        Route::put('/{project}', [ProjectController::class, 'update'])->whereNumber('project');
        Route::delete('/{project}', [ProjectController::class, 'delete'])->whereNumber('project');

        Route::post('/{project}/assign/{user}/role/{role}', [AssignUserController::class, 'assignUser'])->whereNumber(['project', 'user', 'role']);
        Route::post('/{project}/remove/{user}', [AssignUserController::class, 'removeUser'])->whereNumber(['project', 'user']);
    });
});
