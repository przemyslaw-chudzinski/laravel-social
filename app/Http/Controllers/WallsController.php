<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class WallsController extends Controller
{
    public function index()
    {
      $friends = Auth::user()->friends();
      $friends_ids_array = [];
      $friends_ids_array[] = Auth::user()->id;
      foreach ($friends as $friend) {
        $friends_ids_array[] = $friend->id;
      }
      $template_data = [];
      if(Auth::user()->role->type === 'admin'){
        $posts = Post::withTrashed()
                ->with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id',$friends_ids_array)
                ->orderBy('created_at','desc')
                ->paginate(20);
        $template_data = compact('posts');
      }
      else {
        $posts = Post::with('comments.user')
                ->with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id',$friends_ids_array)
                ->orderBy('created_at','desc')
                ->paginate(20);
        $template_data = compact('posts');
      }
      return view('walls.index',$template_data);
    }
}
