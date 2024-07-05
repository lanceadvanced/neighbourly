@extends('layout')
@section('content')
    <div class="container-fluid">
        <h1 class="mt-5">Offers in community</h1>
        <h5 class="text-secondary">{{$address->street}} {{$address->number}}, {{$city->zip}} {{$city->name}}</h5>
        <br>
    </div>
    @foreach($offers as $offer)
        @include('artifacts.offerEntry')
    @endforeach
@endsection
