@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/products.css'])
@endpush

@section('title', 'Seguindo')

@section('content')

<h2 class="title">Artesãos que você segue</h2>

@if($artisans->isEmpty())
    <div class="empty-state">
        <h3>Nenhum artesão seguido.</h3>
        <p> Você ainda não segue nenhum artesão. Explore novos artistas e acompanhe seus trabalhos favoritos.</p>
        <a href="{{ route('customer.artisans.index') }}" class="btn btn-primary btn-medio">
            Explorar Artesãos
        </a>
    </div>
@else

    <div class="dashboard-grid">
        @foreach($artisans as $artisan)
            <x-card_artisan :artisan="$artisan"/>
        @endforeach
    </div>

    <div class="pagination-wrapper">
        {{ $artisans->withQueryString()->links() }}
    </div>
@endif
@endsection