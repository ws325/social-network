<?php use App\Models\Follower; ?>
@extends('layouts.menu')

@section('content')
        <div class="page-header-wrapper">
            <h2>Profile</h2>
        </div>
            <div class="user-profile">
                <h3 class="user-profile-name">{{$user->name}}</h3>
                <span class="user-profile-nick">{{$user->nick}}</span>
                <span class="user-profile-joined">Joined {{$user->created_at}}</span>
                <div class="user-profile-stats">
                    <span class="user-profile-following">following: {{Follower::where('follower_id', $user->id)->get()->count() }}</span>
                    <span class="user-profile-followers">followers: {{$user->followers->count()}}</span>
                </div>
            </div>

            <div class="actions">
                @if ($user->id != Auth::user()->id)
                    <form method="POST" action="{{ route('profile.update', $user )}}" >
                        @csrf
                        @method("PUT")
                       <input id="follow" class="button btn-secondary btn-small" type="submit" value="{{ $user->followers->where('follower_id', Auth::user()->id)->count() == 1 ? 'Unfollow' : 'Follow'}}">
                    </form>

                    @if( Auth::user()->mod)
                    <form method="POST" action="{{ route('moderator.users.ban', $user->id )}}" >
                        @csrf
                        @method("PUT")
                        <input type="submit" class="button btn-secondary btn-small" value="{{ !$user->block ? 'Block' : 'Unblock' }}">
                    </form>

                    <form method="POST" action="{{ route('moderator.users.warning', $user->id )}}" >
                        @csrf
                        @method("PUT")
                        <input type="submit" class="button btn-secondary btn-small" value="{{ 'Give warning'}}">
                    </form>
                    @endif
                @endif
            </div>

            <div class="tabs">
        <ul class="tabs-list">
            <li class="{{ (request()->is('profile/'. $user->id)) ? 'tabs-list-item active' : 'tabs-list-item' }}">
                <a href = "{{ url('/profile/'. $user->id) }}">
                    Tweets
                </a>
            </li>
            <li class="{{ (request()->routeIs('profile.likes.index', $user)) ? 'tabs-list-item active' : 'tabs-list-item' }}">
                <a href = "{{route('profile.likes.index', $user)}}">
                    Likes
                </a>
            </li>
        </ul>
    </div>

    <div>
        @yield('tabs-content', View::make('profile.posts')->withUser($user))
    </div>

@endsection

