@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/product_info.css'])
@endpush

@section('title', $product->name)

@section('content')

<div class="product-page">

    <div class="product-card">

        <div class="product-image-box">
            <img src="{{ asset('storage/' . $product->image_url) }}" 
                 alt="{{ $product->name }}" 
                 class="product-image">
        </div>

        <div class="product-info">

            <h1 class="product-title">{{ $product->name }}</h1>

            <p class="product-price">
                R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>

            <p class="product-description">{{ $product->description }}</p>

            <p class="seller-label">Vendido por</p>
            <a href="{{ route('artesao.perfil', $product->artisan_id) }}" class="seller-name">
                {{ $product->artisan->business_name ?? $product->artisan->name }}
            </a>

            @php
                $average = $product->average_rating ?? 0;
                $full = floor($average);
                $half = ($average - $full) >= 0.5;
                $empty = 5 - $full - ($half ? 1 : 0);
            @endphp

            <div class="rating-box">
                @for($i = 0; $i < $full; $i++)
                    <i class="fa-solid fa-star rating-star"></i>
                @endfor

                @if($half)
                    <i class="fa-regular fa-star-half-stroke rating-star"></i>
                @endif

                @for($i = 0; $i < $empty; $i++)
                    <i class="fa-regular fa-star rating-star"></i>
                @endfor

                <span class="rating-number">({{ number_format($average, 1, ',', '.') }})</span>
            </div>

            <div class="product-buttons">

                <form action="{{ route('produto.favoritar', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary btn-medio">
                        {{ $isFavorited ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos' }}
                    </button>
                </form>

                <form action="{{ route('login', $product->id) }}" >
                    @csrf
                     <button class="btn btn-primary btn-medio">
                         Avaliar Produto
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>

@endsection