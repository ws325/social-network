<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index')->withPosts(Post::all());
    }


    public function show(Post $post)
    {
        return view('posts.show')->withPost($post);
    }

    public function postwithtags(String $tag)
    {
        return view('posts.tags', ['posts'=>(Post::withAnyTags(['#' . $tag])->get()), 'hashtag'=>$tag]);
    }

    public function create()
    {
        return view('posts.create', ['user'=>Auth::user()]);
    }
    public function store( Request $request){
        $this->validate($request, [
            'tweet' => 'required'
        ]);
        $tweet = new Post();
        $tweet->text = $request->tweet;
        $tweet->user_id = Auth::user()->id;
        $tweet->save();
        preg_match_all('/#(\w+)/', $request->tweet, $matches);
        foreach ($matches[0] as $hasztag_name){
            $tweet->attachTag($hasztag_name);
        }
        header("Location: profile/".Auth::user()->id );

        exit;
    }
    public function edit( $id)
    {
        $post = Post::find($id);

       if( $post->user_id == Auth::user()->id){
            $tweet=Post::find($id);
            return view('posts.edit', ['user'=>Auth::user(),'tweet'=>$tweet]);//->withPost($tweet);
        }else echo "nie możesz edytowac nie swoich tweetów";
    }
    public function update( $id, Request $request ){
        $tweet = Post::find($id);
        if( $tweet->user_id == Auth::user()->id){
            $this->validate($request, [
                'tweet' => 'required'
            ]);
            $tweet->text = $request->tweet;
            $tweet->save();
            preg_match_all('/#(\w+)/', $request->tweet, $matches);
            foreach ($matches[0] as $hasztag_name){
                $tweet->attachTag($hasztag_name);
            }
            header("Location: /profile/".Auth::user()->id );
            exit;
        }else echo "nie możesz edytowac nie swoich tweetów";
    }
    public function destroy( $tweet)
    {
        $tweet=Post::find($tweet);
        if ($tweet->user_id == Auth::user()->id) {
            $tweet->delete();
            header("Location: /profile/".Auth::user()->id );
            exit;
        }
        if(Auth::user()->mod)
        {
            $notification = new Notification();
            $notification->message = "Admin usunal twoj post o tresci ".$tweet->text." za naruszenie zasad";
            $notification->user_id = $tweet->user_id;
            $notification->save();
            $tweet->delete();
            return view('dashboardmod');
        }
            else echo "nie możesz usunąć nie swojego tweeta";

    }
}
