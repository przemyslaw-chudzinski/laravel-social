<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Notifications\Liked;
use App\Post;
use App\Comment;
use App\User;

class LikesController extends Controller
{
    public function add(Request $request)
    {
      $data = [
        'post_id' => $request->input('post_id'),
        'user_id' => Auth::user()->id,
        'comment_id' => $request->input('comment_id')
      ];
      $object = null;
      $type = "";
      Like::create($data);

      if(!empty($data['post_id'])){
        $object = Post::findOrFail($data['post_id'])->first();
        $type = "post";
        User::findOrFail($object->user_id)->notify(new Liked($object,$type));
      }
      // if(!empty($data['comment_id'])){
      //   $object = Comment::findOrFail($data['comment_id'])->first();
      //   // $post = Post::findOrFail();
      //   $type = "comment";
      //   User::findOrFail($object->user->id)->notify(new Liked($object,$type));
      // }

      return back();
    }

    public function destroy(Request $request)
    {
      $data = [
        'post_id' => $request->input('post_id'),
        'user_id' => Auth::user()->id,
        'comment_id' => $request->input('comment_id')
      ];
      Like::where($data)->delete();
      return back();
    }
}
