<?php

use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\CadastrarReceitasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MinhasReceitasController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitasFavoritasController;
use App\Http\Controllers\ReceitasProntasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [LoginController::class, 'login']);
Route::get('/inicio', [InicioController::class, 'inicio']);
Route::get('/minhas-receitas', [MinhasReceitasController::class, 'minhasReceitas']);
Route::get('/receitas-favoritas', [ReceitasFavoritasController::class, 'receitasFavoritas']);
Route::get('/receitas-prontas', [ReceitasProntasController::class, 'receitasProntas']);
Route::get('/cadastro-receitas', [CadastrarReceitasController::class, 'cadastrarReceitas']);
Route::get('/perfil', [PerfilController::class, 'perfil']);

require __DIR__.'/auth.php';
