<?php

namespace App\Exceptions;

use Exception;

class JsonException extends Exception
{
    public function render()
    {
//        return redirect()->back()->with('error_checkout', 'Não foi possível concluir este pagamento!');
        return response()->json([
            'status' => 'error',
            'error' => 'Não foi possível concluir este pagamento!',
        ], 400);
    }
}
