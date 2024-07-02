@extends('layout')
@section('head')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="ms-auto">
                                <button class="btn btn-primary me-2" type="submit">Login</button>
                                <button class="btn btn-outline-primary" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="row pt-5 pb-5">
                        <div class="col-sm-4">
                            <img src="{{asset('view/neighbourly.svg')}}" height="200" alt="neighbourly-logo">
                        </div>
                        <div class="col-sm-8 heading-section">
                            <div>
                                <h1>Neighbourly</h1>
                                <h3>Help each other out.</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="carouselExampleDark" class="carousel carousel-dark slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="carousel-slide ">
                                <h1>Create an Account</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-slide">
                                <h1>Join a community</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="carousel-slide">
                                <h1>Get help or offer it</h1>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                @if(!empty(Auth::user()))
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="What do you need?">
                        <button class="btn btn-outline-primary" type="button" id="request-search" data-target="#results"
                                data-api-request="{{route('get-offers-from-request')}}">Search
                        </button>
                    </div>
                    <div id="results"></div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('view/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('view/js/api.js')}}"></script>
    <script type="text/javascript" src="{{asset('view/js/bindings.js')}}"></script>
@endsection

