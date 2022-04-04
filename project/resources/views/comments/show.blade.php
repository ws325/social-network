@extends('layouts.menu')

@section('content')
    <div class="page-header-wrapper">
        <h2>Comments</h2>
    </div>

<div>
    <div class="w-full px-6 py-4 bg-white hover:bg-gray-50 shadow-md overflow-hidden">
        <h1><b>{{ $comment->user->name }}</b>   <small>{{$comment->user->nick}}  {{$comment->fulltime}}</small></h1>
        <hr>
        <p>{{ $comment->text }}</p>
    </div>
</div>
<p>Comment on:</p>
    <div>
        <a class="after:absolute after:inset-0" href="{{route('posts.show',$comment->post)}}">
            <div class="px-6 py-4 bg-white hover:bg-gray-50 shadow-md overflow-hidden">
                <h1 class=""><b>{{ $comment->post->user->name }}</b>   <small>{{$comment->post->user->nick}}  {{$comment->post->time}}</small></h1>
                <hr>
                <p>{{ $comment->post->text }}</p>
            </div>
        </a>
    </div>

@stop
