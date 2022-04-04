<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Follower;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index');
    }
    public function show( Notification $notification ){
        $notification->seen=true;
        $notification->save();
        return view("notifications.show", ['notification'=>$notification]);
    }
}
