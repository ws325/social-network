@extends('profile.index')
            @section('tabs-content')
                @if( $user->likes->isEmpty() )
                        @if ($user->id == Auth::user()->id)
                            <p class="p-6">You don't have any likes yet.</p>
                        @else
                            <p class="p-6">This user doesn't have any likes yet.</p>
                        @endif
                @else
                    <section class="posts">
                    @foreach($user->likes->reverse() as $like)
                        <div class="post-wrapper">
                                <div class="post-content">
                                    <div class="post-author">
                                        <span class="post-author-name">{{ $like->post->user->name }}</span>
                                        <span class="post-author-nick">{{$like->post->user->nick}}</span>
                                        <span class="post-time">{{$like->post->time}}</span>
                                    </div>
                                    <p>{{ $like->post->text }}</p>
                                </div>
                            <div class="post-row">
                                <form method="POST" action="{{ route("profile.likes.store", [$like->post, $user])}}" >
                                    @csrf
                                    <input id="likes" class="button btn-secondary btn-small" type="submit" value="{{$like->post->likes->where('user_id', Auth::user()->id)->count() == 1 ? "dislike" : "like" }}">
                                    <strong>{{$like->post->likes->count()}}</strong>
                                </form>
                                @if(Auth::user() == $like->post->user)
                                <form method="get" action="{{route("posts.edit", $like->post)}}">
                                    <button class="button btn-secondary btn-small">
                                        {{ __('Edit') }}
                                    </button>
                                </form>
                                <form method="post" action="{{ route('posts.destroy', $like->post) }}">
                                    @csrf
                                    @method("DELETE")
                                    <button id="delete" class="button btn-secondary btn-small">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif
                                <div>
                                    <a class="button btn-secondary btn-small" href={{ route("posts.show", $like->post) }}>Comments</a>
                                    <strong>{{$like->post->comments->count()}}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </section>
                @endif
            @endsection
