@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Artesãos')

@section('content')

<h2 class="title">Artesãos</h2>

<form action="{{ route('cliente.artesaos') }}" method="GET" class="search-form">
    <x-search_bar 
        name="search"
        placeholder="Buscar artesãos..."
        :value="$search"
    />
</form>

@if($artisans->isEmpty() && !$search)
        <div class="no-items">
            <p>Não é possível visualizar artesãos.</p>
        </div>
@else

@if($search && $artisans->isEmpty())
    <div class="no-items">
        <p>Nenhum artesão encontrado para: <strong>{{ $search }}</strong>.</p>
    </div>
@endif

    <div class="artisan-list">
        @foreach($artisans as $artisan)
            <x-card_artisan :artisan="$artisan"/>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $artisans->withQueryString()->links() }}
    </div>
@endif
@endsection