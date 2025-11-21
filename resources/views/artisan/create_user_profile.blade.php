@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/artisan/user_profile.css'])
@endpush

@section('content')
<div class="main-container">
    <form method="POST" action="{{ route('perfil.salvar') }}" enctype="multipart/form-data">
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
        <input type="file" id="profile_image" name="profile_image" class="d-none">
        <div class="input-group">
            <label for="business_name" class="input-label">
                Nome Comercial
            </label>
            <input 
                type="text" 
                id="business_name" 
                name="business_name"
                class="input-text"
            >
        </div>
        <div class="input-group">
            <label for="bio" class="input-label">
                Biografia
            </label>
            <textarea name="bio" id="bio"></textarea>
        </div>
            <button type="submit" class="btn btn-primary btn-largo">
                Finalizar Cadastro
            </button>
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
</script>
@endpush