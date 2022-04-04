@extends('layouts.menu')
@if(Auth::user())
@section('content')
    <div class="page-header-wrapper">
        <h2>Moderator</h2>
    </div>
    <div>
        <ul class="recommendation-list">
            @foreach(\App\Models\User::all() as $user)
                <li class="recommendation-list-item">
                    <a class="recommendation-list-item-link" href="{{ url('/profile/'.$user->id) }}">
                        <span class="user-recommended">{{$user->name}} <small>{{$user->nick}}</small></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
@endif
