@vite('resources/css/components/card_product_artisan.css')
@foreach($produtos as $produto)
  <div class="card">
    <img src="{{ asset('storage/' . $produto->imagem) }}" 
         alt="{{ $produto->nome }}" 
         class="card-img">

    <h3 class="card-title">{{ $produto->nome }}</h3>
    <p class="card-price">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

    <div class="card-buttons">
      <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primario btn-pequeno">
        Editar
      </a>
      <form action="{{ route('produtos.destroy', $produto->id) }}" 
            method="POST" 
            onsubmit="return confirm('Tem certeza que deseja excluir este produto?')" 
            style="display:inline">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-secundario btn-pequeno">
            Excluir
          </button>
      </form>
    </div>
  </div>
@endforeach

