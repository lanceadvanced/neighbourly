@extends('layout')
@section('content')
    <div class="container-fluid">
        <h4 class="mt-5">Results for</h4>
        <h2>"{{$searchTerm}}"</h2>
        <br>
        <h6 class="card-subtitle mb-4 text-body-secondary">Community: {{$address->street}} {{$address->number}}, {{$city->zip}} {{$city->name}}</h6>
    </div>
    @foreach($offers as $offer)
        @include('artifacts.offerEntry')
    @endforeach
@endsection
