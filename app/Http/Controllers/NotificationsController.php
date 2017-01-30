<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Notifications\DatabaseNotification as Notification;
use Auth;

class NotificationsController extends Controller
{
    public function index()
    {
      return view('notifications.index');
    }

    public function update(Request $request,$id)
    {
      Notification::where([
        'id' => $id,
        'notifiable_id' => Auth::id()
      ])->firstOrFail()->markAsRead();
      return back();
    }
}
