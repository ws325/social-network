<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function index($id)
    {
        $user =User::find($id);

        return view('likes.index')->withUser($user);
    }
    public function store( User $user, $post, Request $request){
        $post = Post::find($post);
        if( $post->likes->where('user_id', Auth::user()->id)->count() == 0) {
            $notification = new Notification();
            $notification->message = Auth::user()->nick." polubił Twój post \"".$post->text."\"";
            $notification->user_id = $post->user_id;
            $notification->save();
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->post_id = $post->id;
            $like->notification_id = $notification->id;
            $like->save();

        }else {
            foreach (Auth::user()->likes as $like){
                if( $like->post_id == $post->id ){
                    $like->notification->delete();
                    $like->delete();
                }
            }
        }
        header("Location:". $_SERVER['HTTP_REFERER']);
        exit;
    }
}
