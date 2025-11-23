@vite(['resources/css/app.css','resources/css/components/card_product_artisan.css'])
@props(['product'])
<div class="card">
    <img src="{{ asset('storage/' . $product->image_url) }}" 
         alt="{{ $product->name }}" 
         class="card-img">

    <span class="card-title">{{ $product->name }}</span>
    <p class="card-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>

    <div class="card-buttons">
      <form action="{{ route('produto.edicao', $product->id) }}" method="GET">
          <button type="submit" class="btn btn-primary btn-pequeno">
            Editar
          </button>
      </form>
      <form action="{{ route('produtos.excluir', $product->id) }}" 
            method="POST" 
            style="display:inline">
          @csrf
          @method('DELETE')
          <button type="button" class="btn-delete btn btn-secondary btn-pequeno" data-product-name="{{ $product->name }}">
            Excluir
          </button>
      </form>
    </div>
</div>
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {

    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {

            const form = this.closest("form");
            const itemName = this.dataset.productName ?? "este produto";

            showDeleteConfirm(
                `<p>Tem certeza que deseja excluir <strong>${itemName}</strong>?</p>`,
                () => form.submit()
            );

        });
    });

});
</script>
@endpush
