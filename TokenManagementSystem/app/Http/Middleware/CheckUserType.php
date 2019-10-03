<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $checkUserType)
    {
        if(strtolower(Auth::user()->type) !== strtolower($checkUserType)){
            return abort(404);
        }
        return $next($request);
    }
}
