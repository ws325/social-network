<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follower;
use App\Models\Notification;

class ProfileController extends Controller
{
    public function index(User $user) //$user przekazuje nam id usera
    {
        return view('profile.index')->withUser($user);
    }

    public function update( $id, Request $request){ //dodaje usera do tablicy followersow
        $user = User::find($id);
        if( $user->id != Auth::user()->id ) {
            if ($user->followers->where('follower_id', Auth::user()->id)->count() == 1) {
                $follow = $user->followers->where('follower_id', Auth::user()->id);
                $follow->each->delete();
            } else {
                $notification = new Notification();
                $notification->message = Auth::user()->nick." zaobserwował cię ";
                $notification->user_id = $user->id;
                $notification->save();
                $follow = new Follower();
                $follow->user_id = $user->id;
                $follow->follower_id = Auth::user()->id;
                $follow->notification_id = $notification->id;
                $follow->save();
            }
        }

//        }
        header("Location:" . $_SERVER['HTTP_REFERER']); //powrot na poprzednia strone
        exit;
    }

}
