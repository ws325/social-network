@extends('layouts.menu')
    @if(Auth::user())
    @section('content')
        <div class="page-header-wrapper">
            <h2>#{{ $hashtag ?? '' }}</h2>
        </div>
        <section class="posts">
            @foreach($posts->reverse() as $post)
                <div class="post-wrapper">
                    <a class="post-link" href="{{route('posts.show',$post)}}">
                        <div class="post-content">
                            <div class="post-author">
                                <a href="{{ url('/profile/'.$post->user->id) }}">
                                <span class="post-author-name">{{ $post->user->name }}</span>
                                <span class="post-author-nick">{{$post->user->nick}}</span>
                                <span class="post-time">{{$post->time}}</span>
                                </a>
                            </div>
                            <p>{!! $post->textwithtag !!}</p>
                        </div>
                    </a>
                    <div class="post-row">
                        <form method="POST" action="{{ route("profile.likes.store", [$post, $post->user])}}" >
                            @csrf
                            <input id="likes" class="button btn-secondary btn-small" type="submit" value="{{$post->likes->where('user_id', Auth::user()->id)->count() == 1 ? "dislike" : "like" }}">
                            <strong>{{$post->likes->count()}}</strong>
                        </form>
                        @if ($post->user->id == Auth::user()->id || Auth::user()->mod )
                            <form method="get" action="{{route("posts.edit", $post)}}">
                                <button class="button btn-secondary btn-small" >
                                    {{ __('Edit') }}
                                </button>
                            </form>
                            <form method="post" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method("DELETE")
                                <button class="button btn-secondary btn-small" >
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        @endif
                        <div>
                            <a class="button btn-secondary btn-small" href={{ route("posts.show", $post) }}>Comments</a>
                            <strong>{{$post->comments->count()}}</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    @endsection
    @endif

