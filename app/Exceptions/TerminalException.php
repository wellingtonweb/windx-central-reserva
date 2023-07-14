<?php

namespace App\Exceptions;

use Exception;

class TerminalException extends Exception
{
    public function render()
    {
        return redirect()->back()->with('error', 'Terminal não encontrado!');
    }
}
