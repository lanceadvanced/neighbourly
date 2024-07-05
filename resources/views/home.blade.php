@extends('layout')
@section('content')
    @if(!empty(Auth::user()))
        @include('artifacts.landing')
    @endif
    <div class="container-fluid">
        <div class="row pt-3 pb-5">
            @if(empty(Auth::user()))
                <div class="col-md-4">
                    <img class="mx-auto d-block" src="{{asset('view/logo.png')}}" height="200" alt="neighbourly-logo">
                </div>
            @endif
            <div class="col-md-8 heading-section">
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
                    <a class="stretched-link link-dark link-underline link-underline-opacity-0" href="{{route('register')}}"><h1>Create an Account</h1></a>
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
@endsection

