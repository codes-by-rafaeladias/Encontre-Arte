<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
    'name' => 'required|string|max:150',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:8|confirmed',
    'type' => 'required|in:customer,artisan',
], [
    'name.required' => 'O campo nome é obrigatório.',
    'email.required' => 'O campo e-mail é obrigatório.',
    'email.email' => 'Digite um e-mail válido: example@dominio.com.',
    'email.unique' => 'Por favor, insira um e-mail válido.',
    'password.required' => 'A senha é obrigatória.',
    'password.min' => 'A senha deve ter no mínimo :min caracteres.',
    'password.confirmed' => 'A confirmação de senha não confere.',
    'type.required' => 'Selecione o tipo de usuário.',
]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'business_name' => null,
            'bio' => null,
            'profile_image' => null,
        ]);

        if ($user->type === 'artisan') {
            Auth::login($user);
            return redirect()->route('perfil.cadastro');
        }

        return redirect()->route('login')->with('success', 'Cadastro feito com sucesso.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectByType(Auth::user());
        }

        return back()->withErrors(['login' => 'E-mail ou senha inválidos.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Redireciona o usuário de acordo com o tipo.
     */
    private function redirectByType(User $user)
    {
        if ($user->type === 'artisan') {
            return redirect()->route('painel.artesao');
        }

        return redirect()->route('painel.cliente');
    }
}
