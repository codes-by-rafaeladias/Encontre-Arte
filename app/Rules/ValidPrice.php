<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPrice implements Rule
{
    /**
     * Determina se o valor é válido.
     */
    public function passes($attribute, $value)
    {
        // Converte vírgula para ponto
        $numeric = floatval(str_replace(',', '.', $value));

        // Verifica se é maior que zero
        return $numeric > 0;
    }

    /**
     * Mensagem de erro.
     */
    public function message()
    {
        return 'O preço deve ser maior que zero.';
    }
}
