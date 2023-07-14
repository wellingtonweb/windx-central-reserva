<?php

namespace App\Exceptions;

use Exception;

class TransactionException extends Exception
{
    public function render()
    {
        return redirect()->back()->with('error', 'Terminal não encontrado!');
    }
}
