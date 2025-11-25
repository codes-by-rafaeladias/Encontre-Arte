@vite(['resources/css/app.css','resources/css/components/card_product_client.css'])
@props(['product', 'favorited'])
<div class="card">
    <form action="{{ route('produto.favoritar', $product->id) }}" method="POST" class="favorite-form">
        @csrf
        <button type="submit" class="favorite-button">
            <i class="{{ $favorited ? 'fa-solid favorited' : 'fa-regular' }} fa-heart"></i>
        </button>
    </form>
    <a href="{{ route('produto.info', $product->slug) }}" class="card-link">
    <img src="{{ asset('storage/' . $product->image_url) }}" 
         alt="{{ $product->name }}" 
         class="card-img">
    <span class="card-title">{{ $product->name }}</span>
    <p class="card-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    </a>
</div>