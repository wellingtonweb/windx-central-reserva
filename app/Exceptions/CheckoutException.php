<?php

namespace App\Exceptions;

use Exception;

class CheckoutException extends Exception
{
    public function render()
    {
        return redirect()->back()->with('error_checkout', 'Não foi possível concluir este pagamento!');
    }
}
