@vite(['resources/css/app.css','resources/css/components/card_product_client.css'])
@props(['product'])
<div class="card">
    <form action="#" method="POST" class="favorite-form">
        @csrf
        <button type="button" class="favorite-button">
            <i class="fa-regular fa-heart"></i>
        </button>
    </form>
    <img src="{{ asset('storage/' . $product->image_url) }}" 
         alt="{{ $product->name }}" 
         class="card-img">
    <span class="card-title">{{ $product->name }}</span>
    <p class="card-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
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
