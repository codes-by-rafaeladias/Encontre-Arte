@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/auth/login.css'])
@endpush

@section('title', 'Login | Encontre Arte')

@section('content')
<div class="login-page">
    <div class="login-left">
        <img src="{{ asset('images/login-picture.jpg') }}" alt="Encontre Arte">
    </div>

    <div class="login-right">
        <div class="login-box">
            <h1 class="login-title">Encontre Arte</h1>

            <form method="POST" action="{{ route('login.entrar') }}" class="login-form">
            @csrf

                    <input type="email" id="email" name="email" class="input-text" placeholder="E-mail" required>

                    <input type="password" id="password" name="password" class="input-text" placeholder="Senha" required>
                    
                <button type="submit" class="btn btn-primary btn-largo">Entrar</button>

            </form>

            @if ($errors->has('login'))
                    <p class="error-message">
                        {{ $errors->first('login') }}
                    </p>
            @endif

            <a href="{{ route('senha.recuperar') }}" class="forgot-link">Esqueceu a senha?</a>

            <hr class="divider">

            <a href="{{ route('cadastro') }}" class="btn btn-secondary btn-largo margin-med">Criar Conta</a>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    inputs = document.querySelectorAll(".input-text");
    inputs.forEach(input => {
        input.addEventListener("input", () => {
            const errorMessage = document.querySelector(".error-message");
            if (errorMessage) errorMessage.style.display = "none";
        });
    });
});
</script>
@endpush