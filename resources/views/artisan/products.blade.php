@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/artisan/products.css'])
@endpush

@section('title', 'Meus Produtos')

@section('content')
<div class="title-action">
    <h2 class="title">Meus Produtos</h2>
    <form action="{{ route('produtos.cadastro') }}" method="GET">
        <button type="submit" class="btn btn-primary btn-medio">
            Novo Produto
        </button>
    </form>
</div>

    @if($products->isEmpty())
        <div class="no-items">
            <p>Você ainda não cadastrou nenhum produto.</p>
        </div>
    @else

    <div class="dashboard-grid">
        @foreach ($products as $product)
            <x-card_product_artisan :product="$product"/>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $products->withQueryString()->links() }}
    </div>

    @endif

@endsection