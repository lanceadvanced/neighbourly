@php use Carbon\Carbon; @endphp
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{$offer['offer']->title}}</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">by {{$offer['account']->firstname}}</h6>
        <p class="card-text">{!! $offer['offer']->text !!}</p>
        @if(empty($no_details))
            <a href="{{route('details', ['offerID' => $offer['offer']->getKey()])}}" class="card-link stretched-link">View
                offer</a>
        @endif
    </div>
    @if(!empty($timestamps))
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <span
                    class="card-subtitle text-body-secondary">offer starts:</span> {{empty($offer['offer']->start) ? '–' : Carbon::parse($offer['offer']->start)->format('d.m.Y')}}
                <br>
                <span
                    class="card-subtitle text-body-secondary">offer ends:</span> {{empty($offer['offer']->end) ? '–' : Carbon::parse($offer['offer']->end)->format('d.m.Y')}}
            </li>
            @if(!empty($edit))
                <li class="list-group-item">
                    <a href="{{route('editOffer', ['offerID' => $offer['offer']->getKey()])}}">Edit this
                        offer</a><br><br>
                    <a href="{{route('deleteOffer', ['offerID' => $offer['offer']->getKey()])}}">Delete this offer</a>
                </li>
            @endif
        </ul>
    @endif
</div>
