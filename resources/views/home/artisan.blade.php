@extends('layouts.home')

@section('content')
@section('title', 'Painel do Artesão')
<div class="dashboard-grid">
    <x-card_button icone="fa-solid fa-cart-shopping" titulo="Produtos" rota="artesao.produtos"/>
    <x-card_button icone="fa-solid fa-star" titulo="Avaliações" rota="cadastro"/>
    <x-card_button icone="fa-solid fa-user" titulo="Perfil de Usuário" rota="perfil.usuario"/>
</div>
@endsection