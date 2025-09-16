<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PollController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
});

// Task routes
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/{task}/toggle', [TaskController::class, 'toggleComplete']);
});

// Poll routes
Route::post('polls', [PollController::class, 'store'])->middleware('auth:api');
Route::get('polls/{poll}', [PollController::class, 'show']);
Route::post('polls/{poll}/vote', [PollController::class, 'vote']);
Route::get('polls/{poll}/results', [PollController::class, 'results']);
Route::get('my/polls', [PollController::class, 'mine'])->middleware('auth:api');
