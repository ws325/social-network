<html>
<head>
    <title>Twitter</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
</head>
<body>


<div class="layout">
    @if(Auth::user())
        <div class="left-col">
            <nav class="navigation">
                <ul class="navigation-list">
                    <li class="navigation-item">
                        <a class="{{ (request()->is('/')) ? 'navigation-link active' : 'navigation-link' }}" href="{{ url('/') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="navigation-item">
                        <a class="{{ (request()->is('profile/'.Auth::user()->id)) ? 'navigation-link active' : 'navigation-link' }}" href="{{ url('/profile/'.Auth::user()->id) }}">{{ __('Profile') }}</a>
                    </li>
                    <li class="navigation-item">
                        <a class="{{ (request()->routeIs('notifications.index')) ? 'navigation-link active' : 'navigation-link' }}" href="{{ route('notifications.index') }}">{{ __("Notifications ". Auth::user()->notifications->where('seen', false)->count()) }}</a>
                    </li>
                    <li class="navigation-item">
                        <a class="{{ (Auth::user()->mod) ? 'dashboard-link' : 'dashboard-link-hid' }}" href="{{ url('/dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="navigation-item">
                        <a class="{{ (request()->routeIs('posts.create')) ? 'button-link active' : 'button-link' }}" href="{{ route('posts.create') }}">{{ __('Tweet') }}</a>
                    </li>
                </ul>
            </nav>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="button btn-secondary btn-logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
        <main class="main">
            <div class="w-full bg-gray-400">@yield('content')</div>
        </main>
        <div class="right-col">
            <section class="card">
                <div>
                    <h2 class="card-header">Who to follow</h2>
                    <ul class="recommendation-list">
                        @foreach(Auth::user()->recommendation as $item)
                            <li class="recommendation-list-item">
                                <a class="recommendation-list-item-link" href="{{ url('/profile/'.$item['user']->id) }}">
                                    <span class="user-recommended">{{$item['user']->name}}</span>
                                    <span class="user-recommended">mutual users: {{$item['mutuals']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <section class="card">
                <div>
                    <h2 class="card-header">Trends</h2>
                    <ul class="recommendation-list">
                        @foreach(Auth::user()->trend as $item)
                            <li class="recommendation-list-item">
                                <a class="recommendation-list-item-link" href="{{ url('/hashtag/'.$item['hasztag']) }}">
                                    <span class="user-recommended">#{{$item['hasztag']}}</span>
                                    <span class="user-recommended">posts number: {{$item['posts_number']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <footer class="footer">
            @yield('footer')
        </footer>
</div>
@endif

</body>
</html>
