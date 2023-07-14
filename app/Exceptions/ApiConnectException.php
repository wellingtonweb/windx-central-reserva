<?php

namespace App\Exceptions;

use Exception;

class ApiConnectException extends Exception
{
    public function render()
    {
        abort(500);
    }
}
