<?php

namespace App\Helpers;

use App\Friend;
use Auth;

class UserHelper {

  static function friendship($id)
  {
      if(!isset($id)){
        throw new Exception('id is required');
      }

      $friendship = Friend::where([
        'user_id' => Auth::user()->id,
        'friend_id' => $id
      ])->orWhere([
        'user_id' => $id,
        'friend_id' => Auth::user()->id
      ]);

      return [
        'exists' => $friendship->exists(),
        'accepted' => isset($friendship->get()->first()->accepted) ? $friendship->get()->first()->accepted : false
      ];

  }

  static function has_invitation($id)
  {
    if(!isset($id)){
      throw new Exception('id is required');
    }

    return Friend::where([
      'user_id' => $id,
      'friend_id' => Auth::user()->id,
      'accepted' => false
    ])->exists();

  }



}
