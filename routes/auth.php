<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROTAS DE USUÁRIO NÃO AUTENTICADO (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Tela de cadastro
    Route::get('register', function () {
        return view('cadastrar');
    })->name('register');

    // Processar cadastro (Breeze controller continua cuidando do banco)
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Tela de login
    Route::get('login', function () {
        return view('login');
    })->name('login');

    // Processar login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Esqueci senha
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Reset de senha
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| ROTAS DE USUÁRIO AUTENTICADO
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // 🔥 TELA PRINCIPAL DO SISTEMA
    Route::get('/inicio', function () {
        return view('inicio');
    })->name('inicio');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Verificação de email
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Confirmar senha
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Atualizar senha
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');
});