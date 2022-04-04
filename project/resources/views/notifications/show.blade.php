@extends('layouts.menu')

@section('content')

    <div class="page-header-wrapper">
        <h2>Notification</h2>
    </div>

    <div class="notifications">
        <div class="notification">
            <span class="notification-text">{{$notification->creates_at}}</span>
            <span class="notification-text">{{$notification->message}}</span>
        </div>
    </div>
@stop
