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
      $id = null;
      Like::create($data);
      if(!empty($data['post_id'])){
        $object = Post::findOrFail($data['post_id']);
        $type = "post";
        $id = $object->user_id;
        if($id != $data['user_id']){
          User::findOrFail($id)->notify(new Liked($object,$type));
        }
      }
      if(!empty($data['comment_id'])){
        $object = Comment::findOrFail($data['comment_id']);
        $id = Post::findOrFail($object->post_id)->first()->user_id;
        $type = "comment";
        if($object->user_id != $data['user_id']){
          User::findOrFail($id)->notify(new Liked($object,$type));
        }
      }

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
