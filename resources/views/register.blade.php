@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-3">Register</h1>
                <form method="post" action="{{route('register')}}">
                    @csrf
                    <label class="form-label" for="company">Firstname:&nbsp;</label>
                    <input class="form-control" type="text" name="firstname" id="firstname" value="{{old('firstname')}}">
                    <br>
                    @foreach($errors->get('firstname') as $error)
                        <br>{{$error}}
                    @endforeach
                    <label class="form-label" for="lastname">Lastname:&nbsp;</label>
                    <input class="form-control" type="text" name="lastname" id="lastname" value="{{old('lastname')}}">
                    <br>
                    @foreach($errors->get('lastname') as $error)
                        <br>{{$error}}
                    @endforeach
                    <label class="form-label" for="email">Email:&nbsp;</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}">
                    @foreach($errors->get('email') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="password">Password:&nbsp;</label>
                    <input class="form-control" type="password" name="password" id="password">
                    @foreach($errors->get('password') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="password_confirmation">Repeat:&nbsp;</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    @foreach($errors->get('password_confirmation') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="phone">Phone (visible to your community, optional):&nbsp;</label>
                    <input class="form-control" type="text" name="phone" id="phone" value="{{old('phone')}}">
                    @foreach($errors->get('phone') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <label class="form-label" for="contact-email">Contact email (visible to your community, optional):&nbsp;</label>
                    <input class="form-control" type="email" name="contact-email" id="contact-email" value="{{old('contact-email')}}">
                    @foreach($errors->get('contact-email') as $error)
                        <br>{{$error}}
                    @endforeach
                    <br>
                    <input class="btn btn-primary" type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
@endsection
