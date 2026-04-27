@extends('layouts.app')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css', 'resources/css/artisan/create_product.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
@endpush

@section('title', 'Edição de Produto')

@section('content')
<h2 class="page-title">Edição de Produto</h2>
<div class="main-container">
    <form method="POST" action="{{ route('artisan.products.update.update', $product->id) }}" enctype="multipart/form-data">
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
            <input type="file" id="image_url" name="image_url" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp">
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
            <label class="input-label">Categoria
                <span class="required">*</span>
            </label>
            <div class="select-wrapper">
            <select name="category_id" class="select-item @error('category_id') input-error @enderror">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
                </option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="input-group">
            <label class="input-label">Técnica
                <span class="required">*</span>
            </label>
            <div class="select-wrapper">
            <select name="technique_id" class="select-item @error('technique_id') input-error @enderror">
                <option value="">Selecione a técnica utilizada</option>
                @foreach($techniques as $technique)
                    <option value="{{ $technique->id }}"
                        {{ old('technique_id', $product->technique_id) == $technique->id ? 'selected' : '' }}>
                        {{ $technique->name }}
                    </option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="input-group">
            <label class="input-label">Materiais</label>
            <select id="materials" name="materials[]" multiple>
                @foreach($materials as $material)
                <option value="{{ $material->id }}"
                    {{ in_array($material->id, old('materials', $product->materials->pluck('id')->toArray())) ? 'selected' : '' }}>
            {{ $material->name }}
        </option>
    @endforeach
            </select>
        </div>
        <div class="input-group">
            <label class="input-label">Status
                <span class="required">*</span>
            </label>
            <div class="select-wrapper">
            <select name="status" class="select-item @error('status') input-error @enderror">
                <option value="">Selecione o status do produto</option>
                <option value="em_estoque" {{ old('status', $product->status) == 'em_estoque' ? 'selected' : '' }}>Em estoque</option>
                <option value="indisponivel" {{ old('status', $product->status) == 'indisponivel' ? 'selected' : '' }}>Indisponível</option>
                <option value="sob_encomenda" {{ old('status', $product->status) == 'sob_encomenda' ? 'selected' : '' }}>Sob encomenda</option>
            </select>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    // preview imagem
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

    // formatar preço
    window.formatPrice = function(input) {
        let value = input.value.replace(/\D/g, ""); 
        value = (value / 100).toFixed(2) + "";     
        value = value.replace(".", ",");            
        input.value = value;
    };

    // limpar erro ao digitar
    document.querySelectorAll(".input-text").forEach(input => {
        input.addEventListener("input", () => {
            input.classList.remove("input-error");
            const errorBox = document.querySelector(".form-error-box");
            if (errorBox) errorBox.style.display = "none";
        });
    });

    document.querySelectorAll(".select-item").forEach(selector => {
        selector.addEventListener("input", () => {
            selector.classList.remove("input-error");
            const errorBox = document.querySelector(".form-error-box");
            if (errorBox) errorBox.style.display = "none";
        });
    });

    const el = document.querySelector("#materials");

    if (el && !el.tomselect) {
        new TomSelect(el, {
            plugins: ['remove_button'],
            create: false,
            maxItems: 5,
            placeholder: "Selecione os materiais"
        });
    }

});
</script>
@endpush