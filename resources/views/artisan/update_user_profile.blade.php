@extends('layouts.app')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css'])
@endpush

@section('content')
<h2 class="page-title">Edição de Perfil de Usuário</h2>
<div class="main-container">
    <form method="POST" action="{{ route('perfil.atualizar') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="profile-avatar">
             @if ($user->profile_image)
             <img id="preview" src="{{ asset('storage/' . $user->profile_image) }}" 
             alt="Imagem de perfil" 
             >
             @else
             <div class="profile-placeholder">
                <i class="fa-regular fa-user"></i>
            </div>
             @endif
        </div>
        <button 
        type="button"
        onclick="document.getElementById('profile_image').click()"
        class="btn btn-primary btn-medio">
            Alterar Imagem
        </button>
        <input type="file" id="profile_image" name="profile_image" class="d-none">
        <div class="input-group">
            <label for="name" class="input-label">
                Nome Completo <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="name" 
                name="name"
                value="{{ old('name', $user->name ?? '') }}"
                class="input-text @error('name') input-error @enderror"
                required
            >
        </div>
        <div class="input-group">
            <label for="business_name" class="input-label">
                Nome Comercial
            </label>
            <input 
                type="text" 
                id="business_name" 
                name="business_name"
                value="{{ old('business_name', $user->business_name ?? '') }}"
                class="input-text"
            >
        </div>
        <div class="input-group">
            <label for="bio" class="input-label">
                Biografia
            </label>
            <textarea name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
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
document.getElementById('profile_image').onchange = function(e) {
    const file = e.target.files[0];
    if (file) {
        const previewImage =  document.querySelector('#preview');
        const profileAvatar = document.querySelector('.profile-avatar');;
        if(previewImage){
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