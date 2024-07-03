@extends('layout')
@section('content')
    <h4 class="mt-5">Results for</h4>
    <h2>"{{$search_term}}"</h2>
    <br>
    <h6 class="card-subtitle mb-4 text-body-secondary">Community: Wohnortstrasse 111, 3111 Bern</h6>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Katzen betreuen</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by Martin</h6>
            <p class="card-text">Hallo liebe Nachbarn, ich hoffe, es geht euch allen gut! Falls jemand von euch eine Betreuung für seine Katzen braucht, helfe ich gerne aus.</p>
            <a href="{{route('details')}}" class="card-link stretched-link">View offer</a>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Hund spazieren führen</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by Mara</h6>
            <p class="card-text">Liebe Nachbarn, ich hoffe, ihr hattet einen schönen Tag! Falls jemand von euch Unterstützung beim Gassi gehen mit seinem Hund braucht, meldet euch.</p>
            <a href="#" class="card-link stretched-link">View offer</a>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Tierfutter kaufen</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by Isabel</h6>
            <p class="card-text">Hallo zusammen, ich hoffe, ihr habt eine gute Woche! Falls jemand von euch Tierfutter oder andere Sachen vom Qualipet benötigt, bringe ich sie euch gerne mit.</p>
            <a href="#" class="card-link stretched-link">View offer</a>
        </div>
    </div>
@endsection
