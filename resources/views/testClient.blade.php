@php
    $formData = collect(empty($requestInfo) ? session()->getOldInput() : $requestInfo);
@endphp
@extends('layout')
@section('title', 'Testclient')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="mt-3">Test request</h2>
                <form action="{{route('send-test-request')}}" method="post">
                    @csrf
                    <textarea class="form-control mt-3" type="text" name="requested-service">{{$formData->get('requested-service')}}</textarea>
                    <input class="w-auto btn btn-success mt-3" type="submit" value="send" />
                </form>
                <hr>
                <h2>Response</h2>
                <code>
                    @json($response)
                </code>
            </div>
            <div class="col-sm-6">
                <h2 class="mt-3">Sample offers</h2>
                <form action="{{route('create-sample-offer')}}" method="post">
                    @csrf
                    <input placeholder="title" class="form-control mt-3" type="text" name="title" value="{{$formData->get('title')}}">
                    <textarea placeholder="text" class="form-control mt-3" type="text" name="text">{{$formData->get('text')}}</textarea>
                    <input class="w-auto btn btn-success mt-3" type="submit" value="create sample offer" />
                </form>
                <hr>
                <h2 class="mt-3">Sample offers</h2>
                <div class="container-fluid mt-3">
                    @foreach($sampleOffers as $sampleOffer)
                        <div class="row mt-3">
                            <div class="col-sm-9">{{$sampleOffer->title}}<br>{{$sampleOffer->text}}</div>
                            <div class="col-sm-3"><a class="btn btn-danger" href="{{route('delete-sample-offer', ['offerID' => $sampleOffer->getKey()])}}">Löschen</a></div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
