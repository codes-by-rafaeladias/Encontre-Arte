<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserProfileController;

//auth

//rota inicial do sistema
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'register'])->name('cadastro.salvar');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.entrar');
Route::get('/sair', [AuthController::class, 'logout'])->name('logout');

Route::get('/esqueci_senha', [PasswordController::class, 'showForgotForm'])->name('senha.recuperar');
Route::post('/esqueci_senha', [PasswordController::class, 'sendResetLink'])->name('senha.email');

Route::get('/redefinir_senha/{token}', [PasswordController::class, 'showResetForm'])->name('senha.redefinir');
Route::post('/redefinir_senha', [PasswordController::class, 'resetPassword'])->name('senha.atualizar');

Route::post('/enviar_link', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link de verificação reenviado!');
})->middleware(['auth', 'throttle:6,1'])->name('email.enviar_link');

// Dashboards separados
Route::get('/painel/artesao', function () {
    return view('home.artisan');
})->middleware('auth')->name('painel.artesao');

Route::get('/painel/cliente', function () {
    return view('home.costumer');
})->middleware('auth')->name('painel.cliente');

Route::get('/cadastro_perfil_usuario', [UserProfileController::class, 'showCreateProfileForm'])->name('perfil.cadastro');
Route::patch('/cadastro_perfil_usuario', [UserProfileController::class, 'create'])
    ->name('perfil.salvar');
Route::get('/perfil_usuario', [UserProfileController::class, 'showUpdateProfileForm'])->middleware('auth')->name('perfil.usuario');
Route::patch('/perfil_usuario', [UserProfileController::class, 'update'])
    ->name('perfil.atualizar');

Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
