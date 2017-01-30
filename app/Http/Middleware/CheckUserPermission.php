<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Auth;

class CheckUserPermission
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
        if(Auth::user()->id != $request->segment(2)){
          abort(403);
        }
        return $next($request);
    }
}
