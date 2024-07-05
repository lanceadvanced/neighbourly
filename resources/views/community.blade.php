@extends('layout')
@section('content')
    <div class="card mt-5 mb-3">
        <div class="card-body">
            <h1 class="card-title mt-3">Your community</h1>
            <h5 class="card-subtitle mb-2 text-body-secondary">{{$address->street}} {{$address->number}}, {{$city->zip}} {{$city->name}}</h5>
            <br>
            <p>Join a different community or <a href="{{route('leaveCommunity')}}">leave your current one</a></p>
            <form method="post" action="{{route('results')}}">
                @csrf
                <div class="input-group">
                    <input type="text" name="address" class="form-control"
                           placeholder="To search for a community, enter an address"
                           aria-label="address search" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="community-search" data-target="#communities"
                            data-api-request="{{route('get-communities-by-address')}}">Find
                    </button>
                </div>
                <div id="communities" class="w-100">
                </div>
                <br>
                <p class="mt-3">Couldn't find your community? <a href="{{route('createCommunity')}}">Create a new one</a></p>
            </form>
        </div>
    </div>
@endsection
