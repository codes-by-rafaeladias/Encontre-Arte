@vite(['resources/css/app.css','resources/css/components/card_product_artisan.css'])
@props(['product'])
<div class="card-product">

    <div class="card-image-wrapper">

        <img src="{{ asset('storage/' . $product->image_url) }}" 
             alt="{{ $product->name }}" 
             class="card-img">

        <div class="card-overlay">
            <form action="{{ route('artisan.products.update.index', $product->id) }}" method="GET">
                <button type="submit" class="overlay-btn">
                    <i class="fa-solid fa-pen"></i>
                </button>
            </form>

            <form action="{{ route('artisan.products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="button"
                        class="overlay-btn btn-delete"
                        data-product-name="{{ $product->name }}">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>

    </div>

    <div class="card-content">
        <span class="card-title">{{ $product->name }}</span>

        <p class="card-price">
            R$ {{ number_format($product->price, 2, ',', '.') }}
        </p>
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
                `<p>Você tem certeza que deseja excluir <strong>${itemName}</strong>? A ação não poderá ser revertida!</p>`,
                () => form.submit()
            );

        });
    });

});
</script>
@endpush
