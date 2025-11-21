@extends('layouts.app')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css', 'resources/css/artisan/create_product.css'])
@endpush

@section('content')
<h2 class="page-title">Cadastro de Produto</h2>
<div class="main-container">
    <form method="POST" action="#" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="image-upload-wrapper">
            <label for="product_image" class="image-upload-box">
                <img id="image_preview" class="preview-image" style="display: none;">
                <div class="upload-text">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>Clique para enviar imagem</p>
                </div>
            </label>
            <input type="file" id="product_image" name="product_image" hidden onchange="previewImage(event)">
        </div>
        <div class="input-group">
            <label for="name" class="input-label">
                Nome <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="name" 
                name="name"
                class="input-text @error('name') input-error @enderror"
                required
            >
        </div>
        <div class="input-group">
            <label for="description" class="input-label">
                Descrição
            </label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div class="input-group">
            <label for="price" class="input-label">
                Preço <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="price" 
                name="price"
                placeholder="0,00"
                class="input-text"
                oninput="formatPrice(this)"
            >
        </div>
        <div class="input-group">
            <label for="category" class="input-label">
                Categoria 
            </label>
            <input 
                type="text" 
                id="category" 
                name="category"
                class="input-text"
            >
        </div>
            <button type="submit" class="btn btn-primary btn-largo">
                Cadastrar
            </button>
    </form>
</div>
@endsection
@push('scripts')
<script>
function previewImage(event) {
    const preview = document.querySelector("#image_preview");
    const textBox = document.querySelector(".upload-text");

    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = "block";

    textBox.style.display = "none";

}

function formatPrice(input) {
    let value = input.value.replace(/\D/g, ""); 
    value = (value / 100).toFixed(2) + "";     

    value = value.replace(".", ",");            

    input.value = value;
}
</script>
@endpush