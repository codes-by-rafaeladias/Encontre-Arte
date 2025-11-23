@extends('layouts.app')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css', 'resources/css/artisan/create_product.css'])
@endpush

@section('content')
<h2 class="page-title">Cadastro de Produto</h2>
<div class="main-container">
    <form method="POST" action="{{ route('produtos.salvar') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="image-upload-wrapper">
                <img id="image_preview" class="preview-image" style="display: none;">
                <div class="upload-text">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
        </div>
        <button 
            type="button"
            onclick="document.getElementById('image_url').click()"
            class="btn btn-primary btn-medio">
            Enviar Imagem
        </button>
        <input type="file" id="image_url" name="image_url" class="d-none">
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
document.getElementById('image_url').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const previewImage =  document.querySelector('#image_preview');
        const container = document.querySelector('.upload-text');
        
        previewImage.src = URL.createObjectURL(file);
        previewImage.style.display = 'block';
        container.style.display = 'none';
    }
};

function formatPrice(input) {
    let value = input.value.replace(/\D/g, ""); 
    value = (value / 100).toFixed(2) + "";     

    value = value.replace(".", ",");            

    input.value = value;
}
</script>
@endpush