<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/task/create', [TaskController::class, 'addTask']);
    Route::get('/todo', [TaskController::class, 'getTasksTodo']);
    Route::get('/inprogress', [TaskController::class, 'getTasksInprogress']);
    Route::get('/done', [TaskController::class, 'getTasksDone']);
    Route::post('/task-change-status/{task}/{status}', [TaskController::class,'changeTaskStatus']);
    Route::post('/task/{task}', [TaskController::class,'updateTask']);
    Route::post('/delete/{task}', [TaskController::class,'deleteTask']);
});

Route::post('/login', [UserController::class, 'login']);
