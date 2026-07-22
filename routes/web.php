<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\MinhasReceitasController;
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
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotas de receitas
    Route::get('/minhas-receitas', [MinhasReceitasController::class, 'minhasReceitas']);
    Route::get('/receitas-favoritas', [ReceitasFavoritasController::class, 'receitasFavoritas']);
    Route::get('/receitas-prontas', [ReceitasProntasController::class, 'receitasProntas']);

    //CRUD DE RECEITAS ----------------------------------
    Route::get('/receitas',              [MinhasReceitasController::class, 'index'])->name('receitas.index');
    Route::get('/receitas/create',       [MinhasReceitasController::class, 'create'])->name('receitas.create');
    Route::post('/receitas',             [MinhasReceitasController::class, 'store'])->name('receitas.store');
    Route::get('/receitas/{id}/view',    [MinhasReceitasController::class, 'view'])->name('receitas.view');
    Route::post('/receitas/{id}/update', [MinhasReceitasController::class, 'update'])->name('receitas.update');
    Route::get('/receitas/{id}/destroy', [MinhasReceitasController::class, 'destroy'])->name('receitas.destroy');
    Route::get('/receitas/search',       [MinhasReceitasController::class, 'search'])->name('receitas.search');
});

require __DIR__.'/auth.php';