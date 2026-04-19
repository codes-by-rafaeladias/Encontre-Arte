@vite(['resources/css/app.css','resources/css/components/card_product_client.css'])
@props(['product', 'favorited'])
<div class="card">
    <form action="{{ route('customer.favorites.create', $product->slug) }}" method="POST" class="favorite-form">
        @csrf
        <button type="submit" class="favorite-button">
            <i class="{{ $favorited ? 'fa-solid favorited' : 'fa-regular' }} fa-heart"></i>
        </button>
    </form>
    <a href="{{ route('customer.product.data', $product->slug) }}" class="card-link">
    <img src="{{ asset('storage/' . $product->image_url) }}" 
         alt="{{ $product->name }}" 
         class="card-img">
    <span class="card-title">{{ $product->name }}</span>
    <p class="card-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
    </a>
</div>