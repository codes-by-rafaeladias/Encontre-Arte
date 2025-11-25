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
            <h2 class="profile-name">{{ $artisan->name }}</h2>

            @if($artisan->business_name)
                <p class="profile-business">{{ $artisan->business_name }}</p>
            @endif

            @if($artisan->bio)
                <p class="profile-bio">{{ $artisan->bio }}</p>
            @endif
        </div>
    </div>

    <hr class="profile-divider">

    <h3 class="gallery-title">Produtos do Artesão</h3>

    @if($products->isEmpty())
        <div class="no-items">
            <p>Este artesão ainda não publicou produtos.</p>
        </div>
    @else
        <div class="product-gallery">
            @foreach($products as $product)
                <a href="{{ route('produto.info', $product->slug) }}" class="gallery-item">
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
