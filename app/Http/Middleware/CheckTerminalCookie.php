<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTerminalCookie
{
    public function handle(Request $request, Closure $next)
    {
//        dd($request->hasCookie('terminal_id'));
        if ($request->hasCookie('terminal_id') === true && $request->hasCookie('terminal_key') === true) {

            return redirect()->route('terminal.login');
        } else {
            return redirect()->route('terminal.locked');
        }
    }
}
