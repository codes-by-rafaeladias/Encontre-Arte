@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/reviews.css'])
@endpush

@section('title', 'Avaliações Recebidas')

@section('content')

<h2 class="title">Avaliações Recebidas</h2>

@if($reviews->isEmpty())
    <div class="no-items">
            <h3>Nenhuma avaliação recebida ainda</h3>
            <p>Você ainda não recebeu avaliações. As opiniões dos clientes aparecerão aqui após as primeiras compras.</p>
    </div>
@else

@if($totalReviews >= 10)

    <x-reviews_kpis
        :media="$averageRating"
        :quantidade="$totalReviews"
        :melhor_produto="$bestProduct"
    />
@endif

<div class="review-list">
    @foreach ($reviews as $review)
        <x-card_rating_artisan 
            :produto="$review->product->name"
            :usuario="$review->user->name"
            :nota="$review->rating"
            :texto="$review->comment"
            :imagem="$review->product->image_url"
            :reviewId="$review->id"
        />
    @endforeach
</div>

<div class="pagination-wrapper">
       {{ $reviews->links() }}
    </div>

@endif

@endsection
