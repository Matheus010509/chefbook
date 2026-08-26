<?php

use App\Http\Controllers\AdminController;
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

 //o usuario precisa estar logado para acessar o dashboard, se nao estiver logado, ele sera redirecionado para a tela de login
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Rotas de receitas
    Route::get('/minhas-receitas', [MinhasReceitasController::class, 'minhasReceitas']);
    Route::get('/receitas-favoritas', [ReceitasFavoritasController::class, 'receitasFavoritas']);
    Route::get('/receitas-prontas', [ReceitasProntasController::class, 'receitasProntas']);

    //CRUD DE RECEITAS
    Route::get('/receitas',              [MinhasReceitasController::class, 'index'])->name('receitas.index');
    Route::get('/receitas/create',       [MinhasReceitasController::class, 'create'])->name('receitas.create');
    Route::post('/receitas',             [MinhasReceitasController::class, 'store'])->name('receitas.store');
    Route::get('/receitas/{id}/view',    [MinhasReceitasController::class, 'view'])->name('receitas.view');
    Route::post('/receitas/{id}/update', [MinhasReceitasController::class, 'update'])->name('receitas.update');
    Route::get('/receitas/{id}/destroy', [MinhasReceitasController::class, 'destroy'])->name('receitas.destroy');
    Route::get('/receitas/search',       [MinhasReceitasController::class, 'search'])->name('receitas.search');
});
 //Rotas de admin, uso o middleware admin para que apenas o usuário com id = 1, que é o admin, possa acessar essas rotas
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/',               [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create',         [AdminController::class, 'create'])->name('admin.create');
    Route::post('/',              [AdminController::class, 'store'])->name('admin.store');
    Route::get('/{id}/edit',      [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/{id}/update',   [AdminController::class, 'update'])->name('admin.update');
    Route::get('/{id}/destroy',   [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('/search',         [AdminController::class, 'search'])->name('admin.search');
});

require __DIR__.'/auth.php';