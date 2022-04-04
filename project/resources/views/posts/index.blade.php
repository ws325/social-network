@extends('layouts.menu')
    @if(Auth::user())
    @section('content')
        @foreach($posts->reverse() as $post)
            <div class="post-wrapper">
                <a class="post-link" href="{{route('posts.show',$post)}}">
                    <div class="post-content">
                        <div class="post-author">
                            <span class="post-author-name">{{ $post->user->name }}</span>
                            <span class="post-author-nick">{{$post->user->nick}}</span>
                            <span class="post-time">{{$post->time}}</span>
                        </div>
                        <p>{!! $post->textwithtag !!}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @endsection
    @endif
