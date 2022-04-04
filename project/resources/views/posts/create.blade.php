@extends('layouts.menu')
@section('content')
    <div class="page-header-wrapper">
        <h2>Add tweet</h2>
    </div>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
     <form method="post" action="{{ route('posts.store') }}">
        @csrf
                    <div class="new-tweet-wrapper">
                        <textarea id='tweet' class="textarea" name="tweet"> {{ old('tweet') }}</textarea>
                        <button class="button btn-secondary btn-mt8">
                            {{ __('Tweetnij') }}
                        </button>
                    </div>
                </form>
        @endsection
