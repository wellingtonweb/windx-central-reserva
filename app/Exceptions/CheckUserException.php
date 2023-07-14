<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Route;

class CheckUserException extends Exception
{
    public function render()
    {
        return redirect()->route('terminal.login')->with('error', 'Desculpe! Não existe usuário logado.');
    }
}
