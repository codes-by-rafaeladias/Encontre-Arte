<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{
    /**
     * Mostra o formulário de "esqueci minha senha".
     */
    public function showForgotForm()
    {
        return view('auth.forgot_password');
    }

    /**
     * Envia o link de redefinição de senha.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
], [
    'email.required' => 'O campo e-mail é obrigatório.',
    'email.email' => 'Por favor, insira um e-mail válido.',
    'email.exists' => 'Por favor, insira um e-mail válido.',
]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Enviamos um link para redefinir sua senha!')
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Mostra o formulário de redefinição (após clicar no e-mail).
     */
    public function showResetForm($token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }

    /**
     * Atualiza a senha no banco de dados.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ],
        [
    'password.required' => 'O campo senha é obrigatório.',
    'password.min' => 'A senha deve ter no mínimo :min caracteres.',
    'password.confirmed' => 'A confirmação de senha não confere.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? back()->redirect()->route('login')->with('success', 'Senha redefinida com sucesso!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
