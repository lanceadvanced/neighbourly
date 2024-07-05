<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Address;
use App\Models\City;
use App\Models\Community;
use App\Models\CommunityAdmin;
use Auth;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class CommunityController extends Controller
{
    public static function getCommunitiesByAddress(Request $request): Factory|Application|View|ApplicationContract
    {
        $addressTerms = explode(' ', $request->get('address'));
        $communities = Community::all()->map(function (Community $community) use ($addressTerms) {
            /** @var Address $address */
            $address = $community->association('address');
            /** @var City $city */
            $city = $address->association('city');
            $hits = 0;
            foreach ($addressTerms as $addressTerm) {
                $hits += str_contains(strtolower("$address->street $address->number $city->zip $city->name"), strtolower($addressTerm)) ? 1 : 0;
            }

            return [
                'community' => $community,
                'address' => $address,
                'city' => $city,
                'hits' => $hits
            ];
        })->filter(function ($community) {
            return $community['hits'] > 0;
        })->sortByDesc(function ($community) {
            return $community['hits'];
        })->toArray();

        return view('artifacts.communities')->with([
            'communities' => $communities
        ]);
    }

    public static function joinCommunity($communityID): Application|Redirector|ApplicationContract|RedirectResponse
    {
        $account = Account::where('fk_userID', '=', Auth::user()->getKey());
        $account->update(['fk_communityID' => $communityID]);
        return redirect('/');
    }

    public static function community(): Factory|Application|View|Redirector|RedirectResponse|ApplicationContract
    {
        $account = Auth::user()->association('account');
        $community = $account->association('community');

        if(empty($community)){
            return redirect('/');
        }

        $address = $community->association('address');
        $city = $address->association('city');

        return view('community')->with([
            'account' => $account,
            'community' => $community,
            'address' => $address,
            'city' => $city,
        ]);
    }

    public static function leaveCommunity(): Application|Redirector|ApplicationContract|RedirectResponse
    {
        Auth::user()->association('account')->update(['fk_communityID' => null]);
        return redirect('/');
    }

    public static function createCommunity(): Factory|Application|View|ApplicationContract
    {
        return view('createCommunity')->with([
            'account' => Auth::user()->association('account')
        ]);
    }

    public static function storeCommunity(Request $request): Application|Redirector|ApplicationContract|RedirectResponse
    {
        $request->validate([
            'street' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $city = City::where('zip', '=', $request->get('zip'))->first();

        if (empty($city)) {
            $city = City::create([
                'zip' => $request->get('zip'),
                'name' => $request->get('city'),
            ]);
        }

        $address = Address::where([
            ['street', '=', $request->get('street')],
            ['number', '=', $request->get('number')],
            ['fk_cityID', '=', $city->getKey()],
        ])->first();

        if (empty($address)) {
            $address = Address::create([
                'street' => $request->get('street'),
                'number' => $request->get('number'),
                'fk_cityID' => $city->getKey(),
            ]);
        }

        $community = Community::where(['fk_addressID' => $address->getKey()])->first();

        if(empty($community)) {
            $community = Community::create([
                'fk_addressID' => $address->getKey()
            ]);

            CommunityAdmin::create([
                'fk_communityID' => $community->getKey(),
                'fk_accountID' => Auth::user()->association('account')->getKey()
            ]);
        }

        Auth::user()->association('account')->update(['fk_communityID' => $community->getKey()]);

        return redirect('/');
    }
}
