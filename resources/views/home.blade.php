@extends('layout')
@section('head')

@endsection
@section('content')
    <div class="card mt-5 mb-3">
        <div class="card-body">
            <h1 class="mt-3">Welcome</h1>
            <h2 class="mb-3">Nadine</h2>
            <h5 class="card-title">Your community</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Wohnortstrasse 111, 3111 Bern</h6>
            <form method="post" action="{{route('results')}}">
                @csrf
                <div class="input-group mb-3 mt-4">
                    <input type="text" name="search-term" class="form-control" placeholder="What do you need help with?" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Find</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row pt-5 pb-5">
            <div class="col-md-4">
                <img class="mx-auto d-block" src="{{asset('view/logo.png')}}" height="200" alt="neighbourly-logo">
            </div>
            <div class="col-md-8 mt-3 heading-section">
                <div>
                    <h1>Neighbourly</h1>
                    <h3>Help each other out.</h3>
                </div>
            </div>
        </div>
    </div>
    <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
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
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('view/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('view/js/api.js')}}"></script>
    <script type="text/javascript" src="{{asset('view/js/bindings.js')}}"></script>
@endsection

