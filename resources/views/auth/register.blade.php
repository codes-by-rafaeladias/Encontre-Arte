@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/auth/register.css'])
@endpush

@section('title', 'Cadastro | Encontre Arte')

@section('content')
<div class="register-box">
    <h1 class="register-title">Cadastre-se Agora</h1>

    <form method="POST" action="{{ route('cadastro.salvar') }}" class="register-form">
        @csrf

        <div class="input-group">
            <label for="name" class="input-label">
                Nome Completo <span class="required">*</span>
            </label>
            <input 
                type="text" 
                id="name" 
                name="name"
                value="{{ old('name') }}"
                class="input-text @error('name') input-error @enderror"
                required
            >
        </div>

        <div class="input-group">
            <label for="email" class="input-label">
                E-mail <span class="required">*</span>
            </label>
            <input 
                type="email" 
                id="email" 
                name="email"
                value="{{ old('email') }}"
                class="input-text @error('email') input-error @enderror"
                required
            >
        </div>

        <div class="input-group">
            <label for="password" class="input-label">
                Senha <span class="required">*</span>
            </label>
            <input 
                type="password" 
                id="password" 
                name="password"
                value="{{ old('password') }}"
                class="input-text @error('password') input-error @enderror"
                required
            >
        </div>

        <div class="input-group">
            <label for="password_confirmation" class="input-label">
                Confirmar Senha <span class="required">*</span>
            </label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation"
                value="{{ old('password_confirmation') }}"
                class="input-text @error('password') input-error @enderror"
                required
            >
        </div>

        <div class="input-group">
            <p class="input-label">
                Selecione o tipo de usuário <span class="required">*</span>
            </p>

            <div class="user-type-group">

                <label class="user-type-option">
                    <input 
                        type="radio" 
                        name="type" 
                        value="artisan"
                        @checked(old('type') === 'artisan')
                        required
                    >
                    <div class="user-type-card">
                        <i class="fa-solid fa-paintbrush"></i>
                        <span>Artesão</span>
                    </div>
                </label>

                <label class="user-type-option">
                    <input 
                        type="radio" 
                        name="type" 
                        value="customer"
                        @checked(old('type') === 'customer')
                        required
                    >
                    <div class="user-type-card">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>Cliente</span>
                    </div>
                </label>

            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-largo">
            Cadastrar
        </button>
    </form>

    @if ($errors->any())
            <div class="form-error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

    <p class="spacing-link">
        Tem uma conta?  
        <a href="{{ route('login') }}">Entre</a>
    </p>

</div>
@endsection
@push('scripts')
<script>
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