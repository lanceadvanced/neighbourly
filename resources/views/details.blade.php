@php use Carbon\Carbon; @endphp
@extends('layout')
@section('content')
    <div class="container-fluid">
        <h5 class="mt-5">Offer:</h5>
        <h2>{{$offer->title}}</h2>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <span class="card-subtitle text-body-secondary">by {{$account->firstname}}</span>
            <div class="profile float-end" style="background: {{$account->color}}">
                <div class="profile-letter">{{substr($account->firstname, 0, 1)}}</div>
            </div>
            <p class="card-text mt-3">{!! $offer->text !!}</p>
        </div>
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
            <li class="list-group-item">
                <span
                    class="card-subtitle text-body-secondary">offer starts:</span> {{empty($offer->start) ? '–' : Carbon::parse($offer->start)->format('d.m.Y')}}
                <br>
                <span
                    class="card-subtitle text-body-secondary">offer ends:</span> {{empty($offer->end) ? '–' : Carbon::parse($offer->start)->format('d.m.Y')}}
            </li>
        </ul>
        <div class="card-body">
            <a href="{{route('profile', ['accountID' => $account->getKey()])}}"
               class="card-link">view {{$account->firstname}}'s profile</a>
        </div>
    </div>
@endsection
