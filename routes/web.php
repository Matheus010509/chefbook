<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MinhasReceitasController;
use App\Http\Controllers\ReceitasFavoritasController;
use App\Http\Controllers\ReceitasProntasController;
use App\Http\Controllers\CadastrarReceitasController;
use App\Http\Controllers\PerfilController;

Route::get('/', [CadastrarController::class, 'cadastrar']);
Route::get('/login', [LoginController::class, 'login']);
Route::get('/inicio', [InicioController::class, 'inicio']);
Route::get('/minhas-receitas', [MinhasReceitasController::class, 'minhasReceitas']);
Route::get('/receitas-favoritas', [ReceitasFavoritasController::class, 'receitasFavoritas']);
Route::get('/receitas-prontas', [ReceitasProntasController::class, 'receitasProntas']);
Route::get('/cadastro-receitas', [CadastrarReceitasController::class, 'cadastrarReceitas']);
Route::get('/perfil', [PerfilController::class, 'perfil']);