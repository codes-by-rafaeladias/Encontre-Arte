@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/reviews.css'])
@endpush

@section('title', 'Avaliações Recebidas')

@section('content')

<h2 class="title">Avaliações Recebidas</h2>

@if($reviews->isEmpty())
    <p class="no-items">Nenhuma avaliação recebida ainda.</p>
@else

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
