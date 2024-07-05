<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Offer;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application as ContractApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Storage;

class OfferController extends Controller
{
    public static function deleteSampleOffer($offerID): Application|Redirector|ContractApplication|RedirectResponse
    {
        Offer::find($offerID)->delete();
        return redirect(route('test-client'));
    }

    public static function createSampleOffer(Request $request): Application|Redirector|ContractApplication|RedirectResponse
    {
        $offer = new Offer();
        $offer->title = $request->get('title');
        $offer->text = $request->get('text');
        $offer->fk_ownerID = Account::find(1)->getKey();
        $offer->save();

        return redirect(route('test-client'));
    }

    #[NoReturn] public static function createSampleOffersFromJSON(): void
    {
        $offers = json_decode(Storage::get('sample_offers.json'), associative: true);
        $createdOffers = [];
        foreach ($offers as $offer) {
            $offer['fk_ownerID'] = 1;
            $createdOffers[] = Offer::create($offer);
        }
        dd(['createdOffers' => $createdOffers]);
    }

    public static function getOffersByCommunity($communityID): Collection
    {
        return Offer::whereIn('fk_ownerID', Account::where('fk_communityID', '=', $communityID)->get()->modelKeys())->get();
    }

    public static function allOffers(): Factory|Application|View|Redirector|RedirectResponse|ContractApplication
    {
        $community = Auth::user()->association('account')->association('community');
        if (empty($community)) {
            return redirect('/');
        }

        $offers = self::getOffersByCommunity($community->getKey())->map(function (Offer $offer) {
            return [
                'offer' => $offer,
                'account' => $offer->association('owner'),
            ];
        });

        return view('allOffers')->with([
            'account' => Auth::user()->association('account'),
            'community' => $community,
            'offers' => $offers,
            'address' => $community->association('address'),
            'city' => $community->association('address')->association('city'),
        ]);
    }

    public static function getOfferResults(Request $request): Factory|Application|View|ContractApplication
    {
        $account = Auth::user()->association('account');
        $community = $account->association('community');
        $address = $community->association('address');
        $matchedOffers = collect(RequestController::getOffersFromRequest(
            $request->get('search-term'),
            $community->getKey()
        ))->map(function ($matchedOffer) {
            $offer = Offer::find($matchedOffer['offerID']);
            $similarity = $matchedOffer['similarity'];
            $account = $offer->association('owner');

            return [
                'offer' => $offer,
                'similarity' => $similarity,
                'account' => $account,
            ];
        })->sortByDesc(function ($matchedOffer) {
            return $matchedOffer['similarity'];
        });

        return view('results')->with([
            'account' => $account,
            'community' => $community,
            'address' => $address,
            'city' => $address->association('city'),
            'offers' => $matchedOffers,
            'searchTerm' => $request->get('search-term')
        ]);
    }

    public static function details($offerID): Factory|Application|View|ContractApplication
    {
        $offer = Offer::find($offerID);
        $account = $offer->association('owner');
        $community = $account->association('community');
        return view('details')->with([
            'offer' => $offer,
            'account' => $account,
            'community' => $community,
        ]);
    }

    public static function myOffers(): Factory|Application|View|ContractApplication
    {
        $account = Auth::user()->association('account');
        $community = $account->association('community');

        $offers = $account->association('offers')->map(function ($offer) use ($account) {
            return [
                'offer' => $offer,
                'account' => $account
            ];
        })->sortByDesc(function ($offer) {
            return $offer['offer']->getKey();
        });

        return view('myOffers')->with([
            'account' => $account,
            'community' => $community,
            'offers' => $offers,
            'timestamps' => true,
            'no_details' => true,
            'edit' => true
        ]);
    }

    public static function deleteOffer($offerID): Application|Redirector|ContractApplication|RedirectResponse
    {
        $offer = Offer::find($offerID);

        if ($offer->association('owner')->association('user')->getKey() == Auth::user()->getKey()) {
            $offer->delete();
            return redirect(route('myOffers'));
        } else {
            return redirect('/');
        }
    }

    public static function createOffer(): Factory|Application|View|ContractApplication
    {
        $account = Auth::user()->association('account');
        $community = $account->association('community');
        return view('offer')->with([
            'account' => $account,
            'community' => $community,
        ]);
    }

    public static function storeOffer(Request $request): Application|Redirector|ContractApplication|RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'start' => ['date', 'nullable'],
            'end' => ['date', 'nullable'],
        ]);

        Offer::create([
            'title' => $request->get('title'),
            'text' => nl2br(e($request->get('text'))),
            'start' => empty($request->get('start')) ? null : Carbon::create($request->get('start')),
            'end' => empty($request->get('end')) ? null : Carbon::create($request->get('end')),
            'fk_ownerID' => Auth::user()->association('account')->getKey(),
        ]);

        return redirect(route('myOffers'));
    }

    public static function editOffer($offerID): Factory|Application|View|Redirector|RedirectResponse|ContractApplication
    {
        $offer = Offer::find($offerID);

        if($offer->fk_ownerID != Auth::user()->association('account')->getKey()) {
            return redirect('/');
        }

        $account = Auth::user()->association('account');
        $community = $account->association('community');
        return view('offer')->with([
            'account' => $account,
            'community' => $community,
            'offer' => $offer,
            'edit' => true,
        ]);
    }

    public static function updateOffer(Request $request, $offerID): Application|Redirector|ContractApplication|RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'start' => ['date', 'nullable'],
            'end' => ['date', 'nullable'],
        ]);

        $offer = Offer::find($offerID);

        if($offer->fk_ownerID != Auth::user()->association('account')->getKey()) {
            return redirect('/');
        }

        $offer->update([
            'title' => $request->get('title'),
            'text' => nl2br(e($request->get('text'))),
            'start' => empty($request->get('start')) ? null : Carbon::create($request->get('start')),
            'end' => empty($request->get('end')) ? null : Carbon::create($request->get('end')),
        ]);

        return(redirect(route('myOffers')));
    }
}
