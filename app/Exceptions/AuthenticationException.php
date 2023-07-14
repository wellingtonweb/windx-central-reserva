<?php

namespace App\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    public function render()
    {
        return redirect()->back()->with('error', 'Desculpe! Credenciais inválidas!');
    }
}
