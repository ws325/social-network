@extends('layouts.menu')
@section('menu')
@endsection
    @section('content')
        <div class="page-header-wrapper">
            <h2>Notifications</h2>
        </div>

        <div class="notifications">
            @if( Auth::user()->notifications->isEmpty() )
                <p>You don't have any notifications.</p>
            @else
                @foreach (Auth::user()->notifications->reverse() as $note )
                    @if( $note->seen )
                        <div class="notification">
                            <a href = "{{ route('notifications.show', $note) }}">
                                <span class="notification-text">{{$note->created_at}}</span>
                                <span class="notification-text">{{$note->message}}</span>
                            </a>
                        </div>
                    @else
                        <div class="notification">
                            <a href = "{{ route('notifications.show', $note) }}">
                                <span class="notification-text">{{$note->created_at}} </span>
                                <span class="notification-text"> {{$note->message}} </span>
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    @endsection
