@extends('layouts.home')

@section('content')
@section('title', 'Painel do Artesão')
<div class="dashboard-grid">
    <x-card_button icone="fa-solid fa-cart-shopping" titulo="Produtos" rota="artisan.products.index"/>
    <x-card_button icone="fa-solid fa-star" titulo="Avaliações" rota="artisan.reviews.index"/>
    <x-card_button icone="fa-solid fa-user" titulo="Perfil de Usuário" rota="artisan.profile.data"/>
</div>
@endsection