<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ArtisanProductController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CustomerArtisanController;
use App\Http\Controllers\ArtisanPublicController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\ArtisanReviewController;
use App\Http\Controllers\CustomerProfileController;

//rota inicial do sistema
Route::get('/', function () {
    return redirect()->route('auth.login');
});

//auth = rotas públicas
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/esqueci-senha', [PasswordController::class, 'showForgotForm'])
        ->name('password.request');
    Route::post('/esqueci-senha', [PasswordController::class, 'sendResetLink'])
        ->name('password.email');
    
    Route::get('/redefinir-senha/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/redefinir-senha', [PasswordController::class, 'resetPassword'])->name('password.update');
    
    Route::post('/enviar-link', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link de verificação reenviado!');
    })->middleware(['auth', 'throttle:6,1'])->name('token.email');

});

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
    Route::get('/artesao/avaliacoes', [ArtisanReviewController::class, 'listReviews']
    )->name('artesao.avaliacoes');
});

//rotas para clientes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/cadastro_perfil_cliente', [CustomerProfileController::class, 'showCreateProfileForm'])->name('cliente.perfil');
    Route::patch('/cadastro_perfil_cliente', [CustomerProfileController::class, 'create'])->name('cliente.salvar_perfil');
    Route::get('/painel/cliente', function () {
    return view('home.customer');
    })->name('painel.cliente');
    Route::get('/perfil_cliente', [CustomerProfileController::class, 'showUpdateProfileForm'])->name('cliente.formulario_atualizar');
    Route::patch('/perfil_cliente', [CustomerProfileController::class, 'update'])->name('cliente.atualizar');
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
    Route::get('/produto/{slug}', [CustomerProductController::class, 'showProduct'])
    ->name('produto.info');
    Route::post('/produto/{slug}', [ProductReviewController::class, 'store'])
    ->name('avaliacao.cadastrar');
    Route::put('/produto/{slug}', [ProductReviewController::class, 'update'])
        ->name('avaliacao.atualizar');
    Route::get('/minhas_avaliacoes', [CustomerReviewController::class, 'showReviews'])
        ->name('cliente.avaliacoes');
    Route::delete('/avaliacao/{id}/excluir', [CustomerReviewController::class, 'destroy'])
        ->name('avaliacao.excluir');
});
