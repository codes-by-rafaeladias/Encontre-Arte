@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Favoritos')

@section('content')
<div class="title-action">
    <h2 class="title">Favoritos</h2>
    
    @if($favoriteProducts->isEmpty())
        <div class="no-items">
            <p>Você ainda não favoritou nenhum produto.</p>
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