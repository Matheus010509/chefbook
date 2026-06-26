<?php

use App\Http\Controllers\Auth\PasswordController;
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
    return redirect('/inicio');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [LoginController::class, 'login']);
Route::get('/minhas-receitas', [MinhasReceitasController::class, 'minhasReceitas']);
Route::get('/receitas-favoritas', [ReceitasFavoritasController::class, 'receitasFavoritas']);
Route::get('/receitas-prontas', [ReceitasProntasController::class, 'receitasProntas']);
Route::get('/cadastro-receitas', [CadastrarReceitasController::class, 'cadastrarReceitas']);

require __DIR__.'/auth.php';