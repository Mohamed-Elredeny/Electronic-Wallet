<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class currency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::get('currency')) {
            Session::put('currency','USD');
        }
        return $next($request);
    }
}
