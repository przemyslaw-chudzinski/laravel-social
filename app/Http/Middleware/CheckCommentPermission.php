<?php

namespace App\Http\Middleware;

use Closure;
use App\Comment;
use Auth;

class CheckCommentPermission
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
      $comment_user_id = Comment::findOrFail($request->comment)->user_id;
      if(Auth::user()->id !== $comment_user_id && Auth::user()->role->type !== 'admin'){
        abort(403,'Brak dostępu');
      }
      return $next($request);
    }
}
