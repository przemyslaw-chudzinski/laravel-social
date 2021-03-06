<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\Helpers\UserHelper as Helper;
use Auth;
use App\User;
use App\Notifications\FriendRequest;
use App\Notifications\FriendRequestAccepted;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $friends = User::findOrFail($id)->friends()->all();
        $template_data = compact('friends');
        return view('friends.index',$template_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function invite($id)
    {
      if(!Helper::friendship($id)['exists'] && !Helper::friendship($id)['accepted']){
        Friend::create([
          'user_id' => Auth::user()->id,
          'friend_id' => $id
        ]);
      User::findOrFail($id)->notify(new FriendRequest);
      }
      else {
        $this->accept($id);
      }
      return back();
    }

    public function accept($id)
    {
      Friend::where([
        'user_id' => $id,
        'friend_id' => Auth::user()->id,
        'accepted' => false
      ])->update(['accepted' => true]);
      User::findOrFail($id)->notify(new FriendRequestAccepted);
      return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Friend::where([
        'user_id' => Auth::user()->id,
        'friend_id' => $id
      ])->orWhere([
        'user_id' => $id,
        'friend_id' => Auth::user()->id
      ])->delete();

      return back();
    }
}
