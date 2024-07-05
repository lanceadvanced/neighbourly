@extends('layout')
@section('content')
    <div class="container-fluid mt-3 clearfix">
        <a href="{{route('createOffer')}}" class="btn btn-success float-end">Create a new offer</a>
    </div>
    <div class="container-fluid mt-3">
        @if($offers->isEmpty())
            <h5>You don't have any offers yet</h5>
        @else
            @foreach($offers as $offer)
                @include('artifacts.offerEntry')
            @endforeach
        @endif
    </div>
@endsection
