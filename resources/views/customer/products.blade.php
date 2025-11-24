@extends('layouts.app')
@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Produtos')
@section('content')
<h2 class="title">Produtos</h2>
    <form action="#" method="GET" class="search-form">
        <x-search_bar 
            name="search" 
            placeholder="Buscar produtos..."
        />
    </form>

    @if($products->isEmpty())
        <div class="no-items">
            <p>No momento, nenhum produto está disponível.</p>
        </div>
    @else

    <div class="dashboard-grid">
        @foreach ($products as $product)
            <x-card_product_client :product="$product" :favorited="in_array($product->id, $favoriteIds)"/>
        @endforeach
    </div>

    @endif

@endsection