<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application as ContractApplication;

class AccountController extends Controller
{
    public static function profile($accountID): Factory|Application|View|ContractApplication
    {
        $account = Account::find($accountID);
        $community = $account->association('community');
        $address = $community->association('address');
        $city = $address->association('city');
        $offers = $account->association('offers')->map(function ($offer) use ($account) {
            return [
                'offer' => $offer,
                'account' => $account
            ];
        });

        return view('profile')->with([
            'account' => $account,
            'community' => $community,
            'address' => $address,
            'city' => $city,
            'offers' => $offers,
            'no_details' => true,
            'timestamps' => true
        ]);
    }
}
