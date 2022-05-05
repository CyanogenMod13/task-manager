<?php

use App\Http\Controllers\Api\AssignUserController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\Notifications\NotificationController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskListController;
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

        Route::post('/{project}/assign-user/{user}/role/{role}', [AssignUserController::class, 'assignUser'])->whereNumber(['project', 'user', 'role']);
        Route::post('/{project}/remove-user/{user}', [AssignUserController::class, 'removeUser'])->whereNumber(['project', 'user']);
    });

    Route::prefix('/task-lists')->group(function () {
        Route::get('/{taskList}', [TaskListController::class, 'show']);
        Route::post('/create', [TaskListController::class, 'create']);
        Route::put('/{taskList}', [TaskListController::class, 'update']);
        Route::delete('/{taskList}', [TaskListController::class, 'delete']);
    });

    Route::prefix('/tasks')->group(function () {
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::post('/create', [TaskController::class, 'create']);
        Route::put('/{task}', [TaskController::class, 'update']);
        Route::delete('/{task}', [TaskController::class, 'delete']);
    });

    Route::prefix('/notifications')->group(function() {
        Route::get('/', [NotificationController::class, 'index']);
        Route::post('/mark-as-read/{notification}', [NotificationController::class, 'markAsRead']);
    });

    Route::prefix('/comments')->group(function () {
        Route::get('/{task}', [CommentController::class, 'index']);
        Route::post('/{task}/publish', [CommentController::class, 'publish']);
        Route::delete('/{comment}', [CommentController::class, 'delete']);
    });
});
