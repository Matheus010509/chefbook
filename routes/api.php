<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReceitaController;

//O meu user so pode se cadastrar no web, entao nao faz sentido ter uma rota de register na api
 //Route::post('/register', [AuthController::class, 'register']);
 
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //rotas de autenticacao
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/receitas', [ReceitaController::class, 'index']); 
    Route::get('/receitas/{receita}', [ReceitaController::class, 'show']);
    Route::get('/receitas-por-categoria', [ReceitaController::class, 'porCategoria']); //vou pegar as receitas "agrupadas" por categoria, para facilitar 
});

