@extends('layouts.app')
@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Produtos')
@section('content')
<h2 class="title">Produtos</h2>
    <form action="{{ route('cliente.produtos') }}" method="GET" class="search-form">
        <x-search_bar 
            name="search" 
            placeholder="Buscar produtos..."
            :value="$search"
        />
    </form>

    @if($products->isEmpty() && !$search)
        <div class="no-items">
            <p>No momento, nenhum produto está disponível.</p>
        </div>
    @else

    @if ($products->isEmpty())
    <div class="no-items">
        <p>Nenhum produto encontrado para: <strong>{{ $search }}</strong></p>
    </div>
    @endif

    <div class="dashboard-grid">
        @foreach ($products as $product)
            <x-card_product_client :product="$product" :favorited="in_array($product->id, $favoriteIds)"/>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $products->withQueryString()->links() }}
    </div>

    @endif
@endsection