@extends('layouts.app')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css', 'resources/css/artisan/create_product.css'])
@endpush

@section('content')
<h2 class="page-title">Edição de Produto</h2>
<div class="main-container">
    <form method="POST" action="{{ route('produto.atualizar', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="image-upload-wrapper">
                @if ($product->image_url)
                <img src="{{ asset('storage/' . $product->image_url) }}" id="image_preview" class="preview-image" alt="Imagem do produto">
                @else
                <div class="upload-text">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                @endif
        </div>
            <button 
            type="button"
            onclick="document.getElementById('image_url').click()"
            class="btn btn-primary btn-medio">
            Alterar Imagem
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
                value="{{ old('name', $product->name) }}"
                class="input-text @error('name') input-error @enderror"
                required
            >
        </div>
        <div class="input-group">
            <label for="description" class="input-label">
                Descrição
            </label>
            <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
        </div>
        @php
        $priceRaw = str_replace('.', ',', $product->price);
        @endphp
        <div class="input-group">
            <label for="price" class="input-label">
                Preço <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="price" 
                name="price"
                value="{{ old('price', $priceRaw) }}"
                class="input-text @error('price') input-error @enderror"
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
                value="{{ old('category', $product->category) }}"
                class="input-text"
            >
        </div>
            <button type="submit" class="btn btn-primary btn-largo">
                Salvar Alterações
            </button>
    @if ($errors->any())
            <div class="form-error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    </form>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('image_url').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const previewImage =  document.querySelector('#image_preview');
        const container = document.querySelector('.image-upload-wrapper');;
        if(previewImage){
            previewImage.src = URL.createObjectURL(file);
            previewImage.style.display = 'block';
        }
        else{
            container.innerHTML = `<img src="${URL.createObjectURL(file)}" id="image_preview" class="preview-image" alt="Imagem do produto">`;
        }
        
    }
};

function formatPrice(input) {
    let value = input.value.replace(/\D/g, ""); 
    value = (value / 100).toFixed(2) + "";     

    value = value.replace(".", ",");            

    input.value = value;
}

document.addEventListener("DOMContentLoaded", () => {
    const inputs = document.querySelectorAll(".input-text");

    inputs.forEach(input => {
        input.addEventListener("input", () => {

            input.classList.remove("input-error");

            const errorBox = document.querySelector(".form-error-box");
            if (errorBox) errorBox.style.display = "none";
        });
    });
});
</script>
@endpush