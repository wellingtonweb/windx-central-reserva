<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivationRequest;
use App\LocalClass\ApiConnect;
use App\Services\API;
use App\Services\Logger;
use App\Services\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class ActivationController extends Controller
{

    public function locked()
    {
        return view('locked');
    }

    public function unlock(ActivationRequest $request)
    {
        $validated = $request->validated();

        if (!$validated)
        {
            Logger::log($validated["terminal_id"],'error','Terminal inválido!');

            return redirect()->back()->withInput()->withErrors($validated);
        }
        else
        {
            $cookie_terminal_id = strval($validated["terminal_id"]);
            $cookie_terminal_key = strval($validated["terminal_key"]);

            $validateTerminal = Validations::validateTerminal($cookie_terminal_id, $cookie_terminal_key);

            if(!$validateTerminal){
                return redirect()->route('terminal.locked')->with('error','Dados do terminal inválidos!');
            }

            Cookie::queue(Cookie::make('terminal_id', $cookie_terminal_id, 2147483647));
            Cookie::queue(Cookie::make('terminal_key', $cookie_terminal_key, 2147483647));

            return redirect()->route('central.login');
        }
    }
}
