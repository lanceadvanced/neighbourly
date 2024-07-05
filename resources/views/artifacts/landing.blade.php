<div class="card mt-5 mb-3">
    <div class="card-body">
        <h1 class="mt-3">Welcome</h1>
        <h2 class="mb-3">{{$account->firstname}}</h2>
        @if(!empty($community))
            <h5 class="card-title">Your community</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">{{$address->street}} {{$address->number}}, {{$city->zip}} {{$city->name}}</h6>
            <form method="post" action="{{route('results')}}">
                @csrf
                <div class="input-group mb-3 mt-4">
                    <input type="text" name="search-term" class="form-control" placeholder="What do you need help with?"
                           aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="submit">Find</button>
                </div>
            </form>
            <p>There are <a href="{{route('allOffers')}}">{{$offers}} offer(s)</a> in your community</p>
        @else
            <h5 class="card-title">You're not in a community yet</h5>
            <form method="post" action="{{route('results')}}">
                @csrf
                <div class="input-group mt-4">
                    <input type="text" name="address" class="form-control" placeholder="To search for a community, enter an address"
                           aria-label="address search" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="community-search" data-target="#communities"
                            data-api-request="{{route('get-communities-by-address')}}">Find
                    </button>
                </div>
                <div id="communities" class="w-100">
                </div>
                <p class="mt-3">Couldn't find your community? <a href="{{route('createCommunity')}}">Create a new one</a></p>
            </form>
        @endif
    </div>
</div>
