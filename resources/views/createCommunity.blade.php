@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <h1 class="mt-3">Create a new community</h1>
                <p class="mb-3 mt-3">Once your community is created, you will join it automatically.</p>
                <form method="post" action="{{route('createCommunity')}}">
                    @csrf
                    <label class="form-label" for="street">Street:&nbsp;</label>
                    <input class="form-control" type="text" name="street" id="street" value="{{old('street')}}">
                    <br>
                    @foreach($errors->get('street') as $error)
                        <br>{{$error}}
                    @endforeach
                    <label class="form-label" for="number">Number:&nbsp;</label>
                    <input class="form-control" type="text" name="number" id="number" value="{{old('number')}}">
                    <br>
                    @foreach($errors->get('number') as $error)
                        <br>{{$error}}
                    @endforeach
                    <label class="form-label" for="zip">Zip-Code:&nbsp;</label>
                    <input class="form-control" type="text" name="zip" id="zip" value="{{old('zip')}}">
                    @foreach($errors->get('zip') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="city">City:&nbsp;</label>
                    <input class="form-control" type="text" name="city" id="city">
                    @foreach($errors->get('city') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <input class="btn btn-primary" type="submit" value="Create community">
                </form>
            </div>
        </div>
    </div>
@endsection
