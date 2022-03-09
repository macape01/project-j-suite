<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CompletionController;

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

Route::apiResource('users', UserController::class);

Route::apiResource('tickets', TicketController::class);

Route::apiResource('messages', MessageController::class);

Route::apiResource('tasks', TaskController::class);

Route::apiResource('tasks/{taid}/notes', NoteController::class);

Route::apiResource('completions', CompletionController::class);

Route::apiResource('tickets/{tid}/comments', CommentController::class);

Route::apiResource('statuses', StatusController::class);
