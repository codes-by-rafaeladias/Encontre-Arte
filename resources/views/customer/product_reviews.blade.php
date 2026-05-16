@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/reviews.css'])
@endpush

@section('title', 'Avaliações')

@section('content')

<h2 class="title">Avaliações do item {{ $product->name }}</h2>

@if($reviews->isEmpty())
    <div class="no-items">
            <h3>Nenhuma avaliação recebida ainda</h3>
            <p>O produto {{ $product->name }} ainda não recebeu nenhuma avaliação.</p>
    </div>
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
