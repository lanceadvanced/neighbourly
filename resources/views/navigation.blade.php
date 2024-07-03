<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        @if(Route::currentRouteName() != 'home')
            <a class="navbar-brand" href="{{route('home')}}">Neighbourly</a>
        @endif
        <div class="ms-auto">
            @if(empty(Auth::user()))
                <div class="profile"></div>
            @else
                @if(Route::currentRouteName() != 'login')
                    <a class="btn btn-primary me-2" href="{{route('login')}}">Login</a>
                @endif
                @if(Route::currentRouteName() != 'register')
                    <a class="btn btn-outline-primary" href="{{route('register')}}">Register</a>
                @endif
            @endif

        </div>
    </div>
</nav>
