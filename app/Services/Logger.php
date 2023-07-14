<?php


namespace App\Services;


use Illuminate\Support\Facades\Log;

class Logger
{

    /*
     *  Types for level
     *   Log::emergency($message);
     *   Log::alert($message);
     *   Log::critical($message);
     *   Log::error($message);
     *   Log::warning($message);
     *   Log::notice($message);
     *   Log::info($message);
     *   Log::debug($message);
     *
     * */

    public function log($login, $level, $message)
    {
        if(session()->has('customer')){
            $message = '[ Usuário: '.$login.' ('.session('customer.id').') ] - ' . $message;
        }else{
            $message = '[ '.$login.' ] - ' . $message;
        }

        Log::channel('single')->$level($message);
    }

}
