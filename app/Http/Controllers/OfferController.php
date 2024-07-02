<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Offer;
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
        foreach($offers as $offer){
            $offer['fk_ownerID'] = 1;
            $createdOffers[] = Offer::create($offer);
        }
        dd(['createdOffers' => $createdOffers]);
    }

    public static function getOffersByCommunity($communityID): Collection
    {
        return Offer::where('fk_ownerID', Account::where('fk_communityID', $communityID)->get()->modelKeys())->get();
    }
}
