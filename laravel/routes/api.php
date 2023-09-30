<?php

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

use App\Http\Controllers\TaskController;

Route::get('/index', [TaskController::class, 'index']);
Route::post('/{task_id}/update', [TaskController::class, 'update']);
Route::post('/{task_id}/delete', [TaskController::class, 'delete']);
Route::post('/create', [TaskController::class, 'create']);