<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand @if(!empty($account)) d-none d-lg-block @endif" href="{{route('home')}}">Neighbourly</a>
        @if(!empty($account))
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item d-md-block d-lg-none pt-2">
                        <a class="navbar-brand" aria-current="page" href="{{route('home')}}">Neighbourly</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('myOffers')}}">My offers</a>
                    </li>
                    @if(!empty($account->association('community')))
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('community')}}">My community</a>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
        <div class="position-absolute top-0 end-0 d-flex mt-2 me-2">
            @if(!empty($account))
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <input class="btn btn-outline-danger me-2" type="submit" value="Logout">
                </form>
                <div class="profile" style="background: {{$account->color}}">
                    <div class="profile-letter">{{substr($account->firstname, 0, 1)}}</div>
                </div>
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
