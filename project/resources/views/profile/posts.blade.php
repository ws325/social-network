@extends('profile.index')
@section('tabs-content')
        @if( $user->posts->isEmpty() )
            @if ($user->id == Auth::user()->id)
            <p class="p-6">You don't have any tweets yet.</p>
            @else
                <p class="p-6">This user doesn't have any tweets yet.</p>
            @endif
        @else

            <section class="posts">
                @foreach($user->posts->reverse() as $post)
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
                            <form method="POST" action="{{ route("profile.likes.store", [$post, $user])}}" >
                                @csrf
                                <input id="likes" class="button btn-secondary btn-small" type="submit" value="{{$post->likes->where('user_id', Auth::user()->id)->count() == 1 ? "dislike" : "like" }}">
{{--                                <input type="checkbox" name="likes" value="likes" {{$post->likes->where('user_id', Auth::user()->id)->count() == 1 ? "checked" : "" }} onchange="this.form.submit()" id="1">--}}
                                <strong>{{$post->likes->count()}}</strong>
                            </form>
                            @if ($user->id == Auth::user()->id)
                            <form method="get" action="{{route("posts.edit", $post)}}">
                                <button class="button btn-secondary btn-small" >
                                    {{ __('Edit') }}
                                </button>
                            </form>
                            @endif
                                @if ($user->id == Auth::user()->id || Auth::user()->mod)
                            <form method="post" action="{{ route('posts.destroy', $post) }}">
                                @csrf
                                @method("DELETE")
                                <button id="delete" class="button btn-secondary btn-small">
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
        @endif
@endsection
