<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ArtisanProfileController;
use App\Http\Controllers\ArtisanProductController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CustomerArtisanController;
use App\Http\Controllers\ArtisanPublicController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\ArtisanReviewController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\ArtisanHomeController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\ArtisanSuggestionController;
use App\Http\Controller\ArtisanConsentController;

//rota inicial do sistema
Route::get('/', [AuthController::class, 'showLogin'])->name('login');

//auth = rotas públicas
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');
    
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
Route::prefix('artesao')->name('artisan.')->middleware(['auth', 'artisan'])->group(function () {
    Route::get('/perfil', [ArtisanProfileController::class, 'showCreateProfileForm'])->name('profile.index');
    Route::patch('/perfil', [ArtisanProfileController::class, 'create'])
    ->name('profile.create');
    Route::get('/', [ArtisanHomeController::class,'home'])
    ->name('home');
    Route::get('/perfil/editar', [ArtisanProfileController::class, 'showUpdateProfileForm'])->name('profile.data');
    Route::patch('/perfil/editar', [ArtisanProfileController::class, 'update'])->name('profile.update');
    Route::get('/produtos', [ArtisanProductController::class, 'listProducts'])->name('products.index');
    Route::get('/produtos/cadastro', [ArtisanProductController::class, 'create'])->name('products.create');
    Route::patch('/produtos/cadastro', [ArtisanProductController::class, 'store'])->name('products.store');
    Route::get('/produtos/{id}/editar', [ArtisanProductController::class, 'showUpdateProductForm'])->name('products.update.index');
    Route::put('/produtos/{id}/editar', [ArtisanProductController::class, 'update'])
        ->name('products.update.update');
    Route::delete('/produtos/{id}', [ArtisanProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/avaliacoes', [ArtisanReviewController::class, 'listReviews']
    )->name('reviews.index');
    Route::get('/sugestoes-inteligentes', [ArtisanSuggestionController::class, 'index']
    )->name('smart-suggestions.index');
});

//rotas para clientes
Route::prefix('cliente')->name('customer.')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/perfil', [CustomerProfileController::class, 'showCreateProfileForm'])->name('profile.index');
    Route::patch('/perfil', [CustomerProfileController::class, 'create'])->name('profile.create');
    Route::get('/', [CustomerHomeController::class, 'home'])->name('home');
    Route::get('/perfil/editar', [CustomerProfileController::class, 'showUpdateProfileForm'])->name('profile.data');
    Route::patch('/perfil/editar', [CustomerProfileController::class, 'update'])->name('profile.update');
    Route::get('/produtos', [CustomerProductController::class, 'listAllProducts'])
     ->name('products.index');
     Route::post('/produto/favoritar/{slug}', [FavoriteController::class, 'toggle'])
    ->name('favorites.create');
    Route::get('/favoritos', [FavoriteController::class, 'listFavorites'])
    ->name('favorites.index');
    Route::get('/artesaos', [CustomerArtisanController::class, 'listArtisans'])
    ->name('artisans.index');
    Route::get('/artesao/{slug}', [ArtisanPublicController::class, 'show'])
    ->name('artisan.profile');
    Route::post('/artesaos/{slug}/seguir', [CustomerArtisanController::class, 'toggleFollow'])
    ->name('artisan.follow');
    Route::get( '/seguindo', [CustomerArtisanController::class, 'followingArtisans'])
    ->name('following.artisans');
    Route::get('/produto/{slug}', [CustomerProductController::class, 'showProduct'])
    ->name('product.data');
    Route::post('/produto/{slug}', [ProductReviewController::class, 'store'])
    ->name('review.create');
    Route::put('/produto/{slug}', [ProductReviewController::class, 'update'])
        ->name('review.update');
    Route::get('/avaliacoes', [CustomerReviewController::class, 'showReviews'])
        ->name('reviews.index');
    Route::delete('/avaliacao/{id}/excluir', [CustomerReviewController::class, 'destroy'])
        ->name('review.destroy');
});
