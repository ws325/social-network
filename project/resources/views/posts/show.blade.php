@extends('layouts.menu')
@section('content')
    <div class="page-header-wrapper">
        <h2>Comments</h2>
    </div>

    <div class="comments-post">
        <div class="post-wrapper">
            <div class="post-content">
                <div class="post-author">
                    <a href="{{ url('/profile/'.$post->user->id) }}">
                        <span class="post-author-name">{{ $post->user->name }}</span>
                        <span class="post-author-nick">{{$post->user->nick}}</span>
                    </a>
                    <span class="post-time">{{$post->time}}</span>
                </div>
                <p>{!! $post->textwithtag !!}</p>
            </div>
        </div>

        <div class="post-comment-wrapper">
            <form class="comment-form" method="POST" action="{{ route('posts.comments.store', $post)}}" >
                @csrf
                <label for="comment" class="comment-label">New comment</label>
                <textarea id='comment' class="comment-textarea" name="comment"  rows="1" cols="60"></textarea>
                <button class="button btn-secondary comment-btn">
                    {{ __('Create') }}
                </button>
            </form>
        </div>
    </div>

    <div class="comment-list-wrapper">
        <ul class="comment-list">
            @foreach($post->comments->reverse() as $comment)
                <li>
                    <div class="comment">
                        <div class="comment-author">
                            <span>{{ $comment->user->name }}</span>
                            <span>{{ $comment->user->nick}}</span>
                            <span>{{$comment->time}}</span>
                        </div>
                        <p class="comment-text">{{ $comment->text }}</p>
                        <div>
                            @if($comment->user->id == Auth::user()->id || Auth::user()->mod )
                                <form method="post" action="{{ route('posts.comments.destroy', [$post, $comment]) }}">
                                    @csrf
                                    @method("DELETE")

                                    <button id="delete" class="button btn-secondary btn-mt8 btn-small">
                                        {{ __('Delete') }}
                                    </button>
                                </form>

                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
{{--        <div>--}}
{{--            @foreach($post->comments as $comment)--}}
{{--                <a class="after:absolute after:inset-0" href="{{route('posts.comments.show', [$post, $comment])}}">--}}
{{--                    <div class="w-full px-6 py-4 bg-white hover:bg-gray-50 shadow-md overflow-hidden">--}}
{{--                        <h1><b>{{ $comment->user->name }}</b>   <small>{{$comment->user->nick}}  {{$comment->time}}</small></h1>--}}
{{--                        <hr>--}}
{{--                        <p>{{ $comment->text }}</p>--}}
{{--                        @if($comment->user->id == Auth::user()->id )--}}
{{--                            <form method="post" action="{{ route('posts.comments.destroy', [$post, $comment]) }}">--}}
{{--                                @csrf--}}
{{--                                @method("DELETE")--}}

{{--                                <x-button class="ml-4">--}}
{{--                                    {{ __('Delete') }}--}}
{{--                                </x-button>--}}
{{--                            </form>--}}

{{--                        @endif--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
@stop
