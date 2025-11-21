@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/auth/register.css'])
@endpush

@section('title', 'Recuperação de Senha')

@section('content')
        <div class="register-box">
            <h1 class="register-title">Recuperação de Senha</h1>

            <form method="POST" action="{{ route('senha.email') }}" class="register-form">
            @csrf
                <div class="input-group">
                    <label for="email" class="input-label">E-mail</label>
                    <input type="email" id="email" name="email" class="input-text @error('email') input-error @enderror" required>
                </div>

                <button type="submit" class="btn btn-primary btn-largo" style="margin-bottom:10px;">Enviar Link de Redefinição</button>

                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </form>

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