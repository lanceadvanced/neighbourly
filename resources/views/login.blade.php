@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h1 class="mt-3">Login</h1>
                <form method="post" action="{{route('login')}}">
                    @csrf
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email">
                    <br>
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" name="password" id="password">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
@endsection
