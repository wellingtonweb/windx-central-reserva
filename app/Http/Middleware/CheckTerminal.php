<?php

namespace App\Http\Middleware;

use App\Services\Validations;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckTerminal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

//        if(!Cookie::has('terminal_id') || !Cookie::has('terminal_key')){
//            return redirect()->route('terminal.locked');
//        }
//
//        $terminal_id = $request->cookie('terminal_id');
//        $terminal_key = $request->cookie('terminal_key');
//
//        $validate = Validations::validateTerminal($terminal_id, $terminal_key);
//
//        if (!$terminal_id || !$terminal_key || $validate === false) {
//            return redirect()->route('terminal.locked');
//        }



//        if($validate){
//            return redirect()->route('terminal.login');
//        }

        return $next($request);
    }
}
