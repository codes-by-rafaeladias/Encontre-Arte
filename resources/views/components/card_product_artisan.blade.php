@vite(['resources/css/app.css','resources/css/components/card_product_artisan.css'])
@props(['product'])
<div class="card">
    <img src="{{ asset('storage/' . $product->image_url) }}" 
         alt="{{ $product->name }}" 
         class="card-img">

    <h3 class="card-title">{{ $product->name }}</h3>
    <p class="card-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>

    <div class="card-buttons">
      <a href="{{ route('produtos.editar', $product->id) }}" class="btn btn-primary btn-pequeno">
        Editar
      </a>
      <form action="{{ route('produtos.excluir', $product->id) }}" 
            method="POST" 
            onsubmit="return confirm('Tem certeza que deseja excluir este produto?')" 
            style="display:inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-secondary btn-pequeno">
            Excluir
          </button>
      </form>
    </div>
</div>