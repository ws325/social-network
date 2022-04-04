@extends('layouts.menu')
@section('content')
    <div class="page-header-wrapper">
        <h2>Edit tweet</h2>
    </div>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form method="post" action="{{ route('posts.update', $tweet) }}">
        @csrf
        @method("PUT")
        <div class="new-tweet-wrapper">
            <textarea class="block mt-1 w-full" name="tweet" >{{$tweet->text}}</textarea>
                <button class="button btn-secondary btn-mt8">
                    {{ __('Edit') }}
                </button>
        </div>
    </form>
@endsection
