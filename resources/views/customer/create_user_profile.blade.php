@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css'])
@endpush

@section('title', 'Cadastro | Encontre Arte')

@section('content')
<div class="main-container">
    <form method="POST" action="{{ route('cliente.salvar_perfil') }}" enctype="multipart/form-data">
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
        class="btn btn-primary btn-medio">
            Enviar Imagem
        </button>
        <input type="file" id="profile_image" name="profile_image" class="d-none" accept="image/png, image/jpeg, image/jpg, image/webp">
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
        const profileAvatar = document.querySelector('.profile-avatar');;
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