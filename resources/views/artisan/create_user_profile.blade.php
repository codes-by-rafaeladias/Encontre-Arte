@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css'])
@endpush

@section('title', 'Cadastro | Encontre Arte')

@section('content')
<div class="main-container">
    <form method="POST" action="{{ route('artisan.profile.create') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="profile-avatar">
            <img id="preview" alt="Imagem de perfil" style="display: none;">
             <div class="profile-placeholder">
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <button 
        type="button"
        onclick="document.getElementById('profile_image').click()"
        class="btn btn-secondary btn-medio">
            Enviar Imagem
        </button>
        <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp">
        <div class="input-group">
            <label for="business_name" class="input-label">
                Nome Comercial
            </label>
            <input 
                type="text" 
                id="business_name" 
                name="business_name"
                value="{{ old('business_name') }}"
                class="input-text @error('business_name') input-error @enderror"
            >
        </div>
        <div class="group-fields">
        <div class="input-group">
            <label for="state" class="input-label">
                Estado <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="state" 
                name="state"
                value="{{ old('state') }}"
                class="input-text @error('state') input-error @enderror"
                required
            >
        </div>
        <div class="input-group">
            <label for="city" class="input-label">
                Cidade <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="city" 
                name="city"
                value="{{ old('city') }}"
                class="input-text @error('city') input-error @enderror"
                required
            >
        </div>
        </div>
        <div class="group-fields">
        <div class="input-group">
            <label for="whatsapp" class="input-label">
                Whatsapp
            </label>
            <input 
                type="text" 
                id="whatsapp" 
                name="whatsapp"
                placeholder="77999999999"
                value="{{ old('whatsapp') }}"
                class="input-text @error('whatsapp') input-error @enderror"
            >
        </div>
        <div class="input-group">
            <label for="instagram" class="input-label">
                Instagram
            </label>
            <input 
                type="text" 
                id="instagram" 
                name="instagram"
                placeholder="@seunome"
                value="{{ old('instagram') }}"
                class="input-text @error('instagram') input-error @enderror"
            >
        </div>
        </div>
        <div class="input-group">
            <label for="bio" class="input-label">
                Sobre o trabalho
            </label>
            <textarea placeholder="Compartilhe como começou, suas inspirações e o que torna seu trabalho único..." name="bio" id="bio">{{ old('bio', '') }}</textarea>
        </div>
        <div class="ai-consent-container">
            <label class="ai-checkbox-label">
            <input type="checkbox" name="ai_consent" value="1">
            Permitir o uso dos meus dados para receber sugestões inteligentes com IA.
            </label>
            <div class="ai-consent-dropdown">
                    <i class="fa-solid fa-circle-question btn-icon"></i>
                <div class="dropdown-text">
                    <span class="ai-advice">Ao habilitar esta opção, informações relacionadas aos seus produtos e indicadores da plataforma poderão ser processadas pela IA para gerar recomendações personalizadas. A autorização pode ser revogada a qualquer momento.</span>
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary btn-largo">
                Finalizar Cadastro
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
document.getElementById('profile_image').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const previewImage =  document.querySelector('#preview');
        const profileAvatar = document.querySelector('.profile-avatar');
        if(previewImage){
            previewImage.style.display = 'block';
            previewImage.src = URL.createObjectURL(file);
        }
        else{
            profileAvatar.innerHTML = `<img src="${URL.createObjectURL(file)}" alt="Imagem de perfil" id="preview">`;
        }
        
    }
};

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