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

            <img src="{{ asset('images/logo-picture.png') }}" alt="Encontre Arte">

            <form method="POST" action="{{ route('auth.login.store') }}" class="login-form">
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

            <a href="{{ route('auth.password.request') }}" class="forgot-link">Esqueceu a senha?</a>

            <hr class="divider">

            <a href="{{ route('auth.register') }}" class="btn btn-secondary btn-largo margin-med">Criar Conta</a>
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