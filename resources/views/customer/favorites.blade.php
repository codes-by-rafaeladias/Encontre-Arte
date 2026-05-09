@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Favoritos')

@section('content')
<div class="title-action">
    <h2 class="title">Produtos Favoritos</h2>
    
    @if($favoriteProducts->isEmpty())
        <div class="empty-state">
            <h3>Nenhum produto favoritado</h3>
            <p> Você ainda não adicionou produtos aos favoritos. Explore novas criações e salve as que mais gostar.</p>
            <a href="{{ route('customer.products.index') }}" class="btn btn-primary btn-medio">
                Explorar Produtos
            </a>
        </div>
    @else

    <div class="dashboard-grid">
        @foreach ($favoriteProducts as $product)
            <x-card_product_client :product="$product" :favorited="true"/>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $favoriteProducts->withQueryString()->links() }}
    </div>

    @endif

@endsection