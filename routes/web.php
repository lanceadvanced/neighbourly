<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TestClientController;
use App\Models\Account;
use App\Models\Address;
use App\Models\City;
use App\Models\Community;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    $account = empty($user) ? null : Account::where('fk_userID', '=', $user->getKey())->get()[0];
    $community = empty($account) ? null : $account->association('community');
    $address = empty($community) ? null : $community->association('address');
    $city = empty($address) ? null : $address->association('city');
    $offers = empty($community) ? 0 : count(OfferController::getOffersByCommunity($community->getKey()));
    return view('home')->with([
        'user' => $user,
        'account' => $account,
        'community' => $community,
        'address' => $address,
        'city' => $city,
        'offers' => $offers
    ]);
})->name('home');

Route::get('test-client', [TestClientController::class, 'viewTestClient'])->name('test-client');
Route::post('send-test-request', [TestClientController::class, 'sendTestRequest'])->name('send-test-request');
Route::get('delete-sample-offer/{offerID}', [OfferController::class, 'deleteSampleOffer'])->name('delete-sample-offer');
Route::post('create-sample-offer', [OfferController::class, 'createSampleOffer'])->name('create-sample-offer');
Route::get('create-sample-offers', [OfferController::class, 'createSampleOffersFromJSON']);

Route::get('join-community/{communityID}', [CommunityController::class, 'joinCommunity'])->name('join-community');

Route::post('results', [OfferController::class, 'getOfferResults'])->name('results');

Route::get('details/{offerID}', [OfferController::class, 'details'])->name('details');

Route::get('community', [CommunityController::class, 'community'])->name('community');

Route::get('leave-community', [CommunityController::class, 'leaveCommunity'])->name('leaveCommunity');

Route::get('create-community', [CommunityController::class, 'createCommunity'])->name('createCommunity');

Route::post('create-community', [CommunityController::class, 'storeCommunity']);

Route::get('all-offers', [OfferController::class, 'allOffers'])->name('allOffers');

Route::get('profile/{accountID}', [AccountController::class, 'profile'])->name('profile');

Route::get('my-offers', [OfferController::class, 'myOffers'])->name('myOffers');

Route::get('offer/delete/{offerID}', [OfferController::class, 'deleteOffer'])->name('deleteOffer');

Route::get('offer/create', [OfferController::class, 'createOffer'])->name('createOffer');

Route::post('offer/create', [OfferController::class, 'storeOffer']);

Route::get('offer/edit/{offerID}', [OfferController::class, 'editOffer'])->name('editOffer');

Route::post('offer/edit/{offerID}', [OfferController::class, 'updateOffer']);

Route::get('initialize', function () {
    $city = new City();
    $city->name = 'Bern';
    $city->zip = '3014';
    $city->save();

    $address = new Address();
    $address->street = 'Hilfikerstrasse';
    $address->number = '4';
    $address->fk_cityID = $city->getKey();
    $address->save();

    $community = new Community();
    $community->fk_addressID = $address->getKey();
    $community->managed = 0;
    $community->save();

    $user = new User();
    $user->name = 'vater@muetter.cz';
    $user->email = 'vater@muetter.cz';
    $user->password = Hash::make('neighbourly_dies_das');
    $user->save();

    $account = new Account();
    $account->fk_communityID = $community->getKey();
    $account->fk_userID = $user->getKey();
    $account->firstname = 'Vater';
    $account->lastname = 'God';
    $account->save();
});

Route::get('c', function(){
   User::find(1)->update(['password' => Hash::make('neighbourly_dies_das')]);
});

require __DIR__ . '/auth.php';
