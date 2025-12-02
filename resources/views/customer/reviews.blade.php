@extends('layouts.app')

@push('styles')
    @vite(['resources/css/app.css', 'resources/css/customer/reviews.css'])
@endpush

@section('title', 'Minhas Avaliações')

@section('content')

<h2 class="title">Minhas Avaliações</h2>

@if($reviews->isEmpty())
    <p class="no-items">Você ainda não avaliou nenhum produto.</p>
@else

<div class="review-list">
    @foreach($reviews as $review)

        <x-card_rating_client 
            :produto="$review->product->name"
            :nota="$review->rating"
            :texto="$review->comment"
            :imagem="$review->product->image_url"
            :reviewId="$review->id"
        />

    @endforeach
</div>

<div class="pagination-wrapper" style="margin-top:0;">
        {{ $reviews->withQueryString()->links() }}
    </div>

@endif

@endsection