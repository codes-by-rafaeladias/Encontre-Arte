@extends('layouts.home')

@section('content')
@section('title', 'Painel do Cliente')
<div class="dashboard-grid">
    <x-card_button icone="fa-solid fa-bag-shopping" titulo="Produtos" rota="cliente.produtos"/>
    <a href="#" class="card-botao">
        <div class="image-hover-container">
            <img src={{ asset('images/artisan-purple.png') }} class="normal-image">
            <img src={{ asset('images/artisan-white.png') }} class="hover-image">
        </div>
    <span class="card-botao__text">Artesãos</span>
    </a>
    <x-card_button icone="fa-solid fa-star" titulo="Avaliações" rota="cadastro"/>
    <x-card_button icone="fa-solid fa-heart" titulo="Favoritos" rota="logout"/>
</div>
@endsection
