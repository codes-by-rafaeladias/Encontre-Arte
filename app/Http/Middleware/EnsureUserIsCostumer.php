<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsCostumer
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->withErrors(['Você precisa estar logado.']);
        }

        if (auth()->user()->type !== 'costumer') {
            return abort(403, 'Acesso negado: somente clientes podem acessar esta área.');
        }

        return $next($request);
    }
}
