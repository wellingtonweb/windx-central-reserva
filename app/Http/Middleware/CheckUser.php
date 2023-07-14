<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckUser
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
        if(session()->has('customer')){
            return redirect()->route('central.contract');
        }
//        if(!session()->has('customer')){
//            return redirect()->route('central.login');
//        }
        return $next($request);
    }


}
