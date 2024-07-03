@extends('layout')
@section('content')
    <h5 class="mt-5">offer:</h5>
    <h2>Katzen betreuen</h2>
    <div class="card mt-4">
        <div class="card-body">
            <span class="card-subtitle text-body-secondary" style="align-self: flex-end; float: left; bottom: 0; line-height: 40px; vertical-align: bottom">by Martin</span><div class="profile m ms-auto"></div>
            <p class="card-text mt-3">Hallo liebe Nachbarn, ich hoffe, es geht euch allen gut! Falls jemand von euch eine Betreuung für seine Katzen braucht, helfe ich gerne aus.</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <span class="card-subtitle text-body-secondary">contact Martin:</span>
                <a href="#">069 420 42 73</a>
            </li>
            <li class="list-group-item">
                <span class="card-subtitle text-body-secondary">offer starts:</span> –<br>
                <span class="card-subtitle text-body-secondary">offer ends:</span> 30.09.2024
            </li>
        </ul>
        <div class="card-body">
            <a href="#" class="card-link">view Martin's profile</a>
        </div>
    </div>
@endsection
