@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/artisan/home.css'])
@endpush

@section('title', 'Início | Painel do Artesão')

@section('content')

<div class="home-header">

    <div>
        <h1 class="home-title">
            Olá, {{ preg_split('/\s+/', trim(auth()->user()->name))[0] }}
        </h1>

        <p class="home-subtitle">
            Acompanhe sua loja e veja como seus produtos estão performando.
        </p>
    </div>
</div>

<x-home_kpis
    :produtos="$productsCount"
    :seguidores="$followersCount"
    :media_avaliacao="$averageRating"
/>

<section class="home-section">

    @if($latestProducts->isEmpty())

        <div class="empty-state">

            <h3>Você ainda não cadastrou produtos</h3>

            <p>
                Comece adicionando suas primeiras criações
                para exibir seu trabalho aos clientes.
            </p>

            <a
                href="{{ route('artisan.products.create') }}"
                class="btn btn-primary btn-medio"
            >
                Cadastrar Produto
            </a>

        </div>

    @else

    <div class="section-header">
        <h2>Últimos produtos cadastrados</h2>

        <a href="{{ route('artisan.products.index') }}">
            Ver todos
        </a>
    </div>

        <div class="products-grid">

            @foreach($latestProducts as $product)

                <x-card_product_artisan
                    :product="$product"
                />

            @endforeach

        </div>

    @endif

</section>

<section class="home-section">

    <div class="smart-card">

        <div class="smart-content">

            <div class="smart-icon">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>

            <div>

                <h2>Sugestões Inteligentes</h2>

                <p>
                    Receba insights baseados nas avaliações
                    dos seus produtos e descubra oportunidades
                    de melhoria para sua loja.
                </p>

            </div>

        </div>

        <a
            href="{{ route('artisan.smart-suggestions.index') }}"
            class="btn btn-primary btn-medio"
        >
            Ver sugestões
        </a>

    </div>

</section>

@endsection