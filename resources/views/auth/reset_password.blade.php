@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/auth/register.css'])
@endpush

@section('title', 'Redefinição de Senha')

@section('content')
        <div class="register-box">
            <h1 class="register-title">Redefinição de Senha</h1>

            <form method="POST" action="{{ route('senha.atualizar') }}" class="register-form">
            @csrf

                <input type="hidden" name="token" value="{{ request('token') }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="input-group">
                    <label for="password" class="input-label">Senha</label>
                    <input type="password" id="password" name="password" class="input-text @error('password') input-error @enderror" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation" class="input-label">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-text @error('password') input-error @enderror" required>
                </div>

                <button type="submit" class="btn btn-primary btn-largo" style="margin-bottom:10px;">Redefinir Senha</button>

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