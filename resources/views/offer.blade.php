@extends('layout')
@section('content')
    @php
        use App\Models\Offer;
        use Carbon\Carbon;

        /** @var Offer $offer */

        $title = !empty(old('title')) ? old('title') : (isset($offer) ? $offer->title : '');
        $text = !empty(old('text')) ? old('text') : (isset($offer) ? $offer->text : '');
        $start = !empty(old('start')) ? old('start') : (isset($offer) ? $offer->start : '');
        $end = !empty(old('end')) ? old('end') : (isset($offer) ? $offer->end : '');
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="mt-3">{{empty($edit) ? 'Create a new offer' : 'Edit offer'}}</h1>
                <form method="post" action="{{empty($edit) ? route('createOffer') : route('editOffer', ['offerID' => $offer->getKey()])}}">
                    @csrf
                    <label class="form-label" for="title">Title:&nbsp;</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{$title}}">
                    @foreach($errors->get('title') as $error)
                        {{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="text">Text:&nbsp;</label>
                    <textarea class="form-control" type="text" name="text" id="text">{{str_replace('<br>', "", str_replace('<br />', "", $text))}}</textarea>
                    @foreach($errors->get('text') as $error)
                        {{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="start">Offer starts:&nbsp;</label>

                    <input class="form-control" type="date" name="start" id="start"
                           value="{{empty($start) ? '' : Carbon::parse($start)->format('Y-m-d')}}">
                    @foreach($errors->get('start') as $error)
                        {{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="end">Offer ends:&nbsp;</label>
                    <input class="form-control" type="date" name="end" id="end"
                           value="{{empty($end) ? '' : Carbon::parse($end)->format('Y-m-d')}}">
                    @foreach($errors->get('end') as $error)
                        {{$error}}
                    @endforeach
                    <br>
                    @if(empty($edit))
                        <input class="btn btn-primary" type="submit" value="Create offer">
                    @else
                        <input class="btn btn-primary" type="submit" value="Edit offer">
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
