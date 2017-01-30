<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['content','user_id'];

    protected $dates = ['deleted_at'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function comments()
    {
        if(Auth::user()->role->type === 'admin'){
          return $this->hasMany('App\Comment')->withTrashed();
        }
        else {
          return $this->hasMany('App\Comment');
        }
    }

    public function likes()
    {
      return $this->hasMany('App\Like');
    }
}
