<?php


namespace App\Services;

use App\Services\API;
use App\Services\Logger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class Validations
{

    public function validateTerminal($terminal_id, $terminal_key)
    {
//        if(Cookie::has('terminal_id') && Cookie::has('terminal_key')){
////            dd(Cookie::has('terminal_id'), Cookie::has('terminal_key'));
////        if(Cookie::get('terminal_id') == null || Cookie::get('terminal_key') == null){
//            return false;
//        }else{
////            $terminal_id = Cookie::get('terminal_id') ;
////            $terminal_key = Cookie::get('terminal_key');

            $terminal = (new API())->getTerminal($terminal_id);

            if($terminal_key != $terminal->data->authorization_key){
                Cookie::queue(Cookie::forget('terminal_id'));
                Cookie::queue(Cookie::forget('terminal_key'));
                session()->forget('terminal');
                return false;
            }else{
                if($terminal->data->active != 'true'){
                    Cookie::queue(Cookie::forget('terminal_id'));
                    Cookie::queue(Cookie::forget('terminal_key'));
                    session()->forget('terminal');
                    return false;
                }else{
                    session()->put('terminal', $terminal);
                    return true;
                }
            }
//        }
    }

    public function validateEmail($email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }


    public function checkHourBackupVigo($schedulesVigo)
    {
        date_default_timezone_set('America/Sao_Paulo');

        $now = Carbon::now();

        foreach ($schedulesVigo as $schedule) {
            $scheduleInit = Carbon::createFromFormat('H:i', trim($schedule));
            $scheduleLimit = Carbon::createFromFormat('H:i', trim($schedule))->addMinutes(15);

            if ($now->between($scheduleInit, $scheduleLimit)) {
                return true;
            }
        }

        return false;
    }
}
