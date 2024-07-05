@extends('layout')
@section('content')
    <div class="card mt-5 mb-3">
        <div class="card-body">
            <h1 class="mt-3">Profile of</h1>
            <h2 class="mb-3">{{$account->firstname}} {{substr($account->lastname, 0, 1)}}.</h2>
            <h5 class="card-title">{{$account->firstname}}'s community</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">{{$address->street}} {{$address->number}},
                {{$city->zip}} {{$city->name}}</h6>
        </div>
        @if(!empty($account->phone) || !empty($account->email))
            <ul class="list-group list-group-flush">
                @if(!empty($account->phone))
                    <li class="list-group-item">
                        <span class="card-subtitle text-body-secondary">call {{$account->firstname}}:</span>
                        <a href="tel:{{$account->phone}}">{{$account->phone}}</a>
                    </li>
                @endif
                @if(!empty($account->email))
                    <li class="list-group-item">
                        <span class="card-subtitle text-body-secondary">mail to {{$account->firstname}}:</span>
                        <a href="mailto:{{$account->email}}">{{$account->email}}</a>
                    </li>
                @endif
            </ul>
        @endif
    </div>
    @foreach($offers as $offer)
        @include('artifacts.offerEntry')
    @endforeach
@endsection
