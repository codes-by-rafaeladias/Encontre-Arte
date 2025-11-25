<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ArtisanProductController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CustomerArtisanController;
use App\Http\Controllers\ArtisanPublicController;

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

//rotas para artesãos
Route::middleware(['auth', 'artisan'])->group(function () {
    Route::get('/cadastro_perfil_usuario', [UserProfileController::class, 'showCreateProfileForm'])->name('perfil.cadastro');
    Route::patch('/cadastro_perfil_usuario', [UserProfileController::class, 'create'])
    ->name('perfil.salvar');
    Route::get('/painel/artesao', function () {
    return view('home.artisan');})
    ->name('painel.artesao');
    Route::get('/perfil_usuario', [UserProfileController::class, 'showUpdateProfileForm'])->name('perfil.usuario');
    Route::patch('/perfil_usuario', [UserProfileController::class, 'update'])->name('perfil.atualizar');
    Route::get('/meus_produtos', [ArtisanProductController::class, 'listProducts'])->name('artesao.produtos');
    Route::get('/produtos/cadastro', [ArtisanProductController::class, 'create'])->name('produtos.cadastro');
    Route::patch('/produtos/cadastro', [ArtisanProductController::class, 'store'])->name('produtos.salvar');
    Route::get('/produtos/{id}/editar', [ArtisanProductController::class, 'showUpdateProductForm'])->name('produto.edicao');
    Route::put('/produtos/{id}', [ArtisanProductController::class, 'update'])
        ->name('produto.atualizar');
    Route::delete('/produtos/{id}', [ArtisanProductController::class, 'destroy'])->name('produtos.excluir');
});

//rotas para clientes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/painel/cliente', function () {
    return view('home.customer');
    })->name('painel.cliente');
    Route::get('/produtos', [CustomerProductController::class, 'listAllProducts'])
     ->name('cliente.produtos');
     Route::post('/produto/favoritar/{id}', [FavoriteController::class, 'toggle'])
    ->name('produto.favoritar');
    Route::get('/favoritos', [FavoriteController::class, 'listFavorites'])
    ->name('favoritos.lista');
    Route::get('/artesaos', [CustomerArtisanController::class, 'listArtisans'])
    ->name('cliente.artesaos');
    Route::get('/artesao/{id}', [ArtisanPublicController::class, 'show'])
    ->name('artesao.perfil');
});

