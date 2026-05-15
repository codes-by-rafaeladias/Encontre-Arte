@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/artisan/home.css'])
@endpush

@section('title', 'Início | Painel do Cliente')

@section('content')

<div class="home-header">

    <div>
        <h1 class="home-title">
            Olá, {{ preg_split('/\s+/', trim(auth()->user()->name))[0] }}
        </h1>

        <p class="home-subtitle">
            Explore produtos artesanais únicos e descubra talentos locais.
        </p>
    </div>
</div>
<section class="home-section">

    <div class="section-header">
        <h2>Explore novas criações</h2>

        <a href="{{ route('customer.products.index') }}">
            Ver mais
        </a>
    </div>

        <div class="products-grid">

            @foreach($products as $product)

                <x-card_product_client
                    :product="$product"
                    :favorited="false"
                />

            @endforeach

        </div>

</section>
<section class="home-section">

     <div class="section-header">
        <h2>Descubra talentos locais</h2>

        <a href="{{ route('customer.artisans.index') }}">
            Ver mais
        </a>
    </div>

    <div class="products-grid">

        @foreach($artisans as $artisan)

            <x-small_card_artisan
                :artisan="$artisan"
            />

        @endforeach

    </div>
</section>
@endsection