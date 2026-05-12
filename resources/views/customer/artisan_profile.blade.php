@extends('layouts.app')

@push('styles')
    @vite(['resources/css/customer/artisan_profile.css'])
@endpush

@section('title', $artisan->name)
@section('content')

<div class="profile-container">

    <div class="profile-header">

        <div class="profile-left">
            @if($artisan->profile_image)
            <img 
                src="{{ asset('storage/'.$artisan->profile_image) }}"
                class="profile-avatar">
            @else
            @php
            $nome = $artisan->name;
            $iniciais = collect(explode(' ', $nome))
            ->map(fn($p) => mb_substr($p, 0, 1))
            ->take(2)
            ->implode('');
        @endphp
        <div class="avatar-str">
            {{ strtoupper($iniciais) }}
        </div>
        @endif
        </div>
        <div class="profile-info">
            <div class="profile-set-names">
            <h1 class="profile-name">{{ $artisan->name }}</h1>

            @if($artisan->business_name)
                <h2 class="profile-business">{{ $artisan->business_name }}</h2>
            @endif
            </div>

            <div class="artisan-location">
                <i class="fa-solid fa-location-dot"></i>
                <span>
                    {{ $artisan->city }} - {{ $artisan->state }}
                </span>
            </div>

            <div class="artisan-stats">
            <p> <strong>{{ $followersCount }}</strong> seguidores</p>
            <p>|</p>
            <p> <strong>{{ $productsCount }}</strong> produtos</p>
            </div>

            <form action="{{ route('customer.artisan.follow', $artisan->slug) }}"
            method="POST">
               @csrf

               @if($isFollowing)
               <button class="following-btn"> Seguindo </button>
               @else
               <button class="follow-btn"> Seguir </button>
               @endif
            </form>
        </div>
    </div>

    <hr class="profile-divider">

    @if($artisan->bio)
    <div class="artisan-biography">
        <h3>História do Artesão</h3>
        <p>
            {{ $artisan->bio }}
        </p>
    </div>
    <hr class="profile-divider">
    @endif

    @if(!($categories->isEmpty()))
    <div class="artisan-tags-section">
        <h3>Categorias</h3>
        <div class="artisan-tags">
        @foreach($categories as $category)
            <span class="tag">
                {{ $category }}
                @if(!$loop->last)
                |
                @endif
            </span>
        @endforeach
        </div>
    </div>
    <hr class="profile-divider">
    @endif

    @if(!($techniques->isEmpty()))
    <div class="artisan-tags-section">
        <h3>Técnicas</h3>
        <div class="artisan-tags">
        @foreach($techniques as $technique)
        <span class="tag">
            {{ $technique }}
            @if(!$loop->last)
            |
            @endif
        </span>
        @endforeach
        </div>
    </div>
    <hr class="profile-divider">
    @endif

    <h3 class="gallery-title">Produtos do Artesão</h3>

    @if($products->isEmpty())
        <div class="no-items">
            <p>Este artesão ainda não publicou produtos.</p>
        </div>
    @else
        <div class="product-gallery">
            @foreach($products as $product)
                <a href="{{ route('customer.product.data', $product->slug) }}" class="gallery-item">
                    <img src="{{ asset('storage/' . $product->image_url) }}"
                         alt="{{ $product->name }}"
                         class="gallery-img">
                    <span class="gallery-name">{{ $product->name }}</span>
                </a>
            @endforeach
        </div>
    @endif

</div>

@endsection
