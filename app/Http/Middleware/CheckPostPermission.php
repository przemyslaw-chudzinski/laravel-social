<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Post;

class CheckPostPermission
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
        $post_user_id = Post::findOrFail($request->post)->user_id;
        if(Auth::user()->id !==  $post_user_id){
          abort(403,'Brak dostępu');
        }
        return $next($request);
    }
}
