@if(!empty($communities))
    <div class="card mt-3">
        <ul class="list-group list-group-flush">
            @foreach($communities as $community)
                <li class="list-group-item">
                    <span class="text-secondary">{{$community['address']->street}} {{$community['address']->number}}, {{$community['city']->zip}} {{$community['city']->name}}</span>
                    <span class="float-end"><a href="{{route('join-community', ['communityID' => $community['community']->communityID])}}">Join this community</a></span>
                </li>
            @endforeach
        </ul>
    </div>
@else
    <p class="mt-3">
        <span class="badge text-bg-warning">No communities found</span>
    </p>
@endif
