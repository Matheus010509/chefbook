<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

//O meu user so pode se cadastrar no web, entao nao faz sentido ter uma rota de register na api
 //Route::post('/register', [AuthController::class, 'register']);
 
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});