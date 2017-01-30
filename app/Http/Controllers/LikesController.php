<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;

class LikesController extends Controller
{
    public function add(Request $request)
    {
      $data = [
        'post_id' => $request->input('post_id'),
        'user_id' => Auth::user()->id,
        'comment_id' => $request->input('comment_id')
      ];
      Like::create($data);
      return back();
    }

    public function destroy()
    {

    }
}
