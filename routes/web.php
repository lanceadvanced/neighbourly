<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\TestClientController;
use App\Models\Account;
use App\Models\Address;
use App\Models\City;
use App\Models\Community;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('test-client', [TestClientController::class, 'viewTestClient'])->name('test-client');
Route::post('send-test-request', [TestClientController::class, 'sendTestRequest'])->name('send-test-request');
Route::get('delete-sample-offer/{offerID}', [OfferController::class, 'deleteSampleOffer'])->name('delete-sample-offer');
Route::post('create-sample-offer', [OfferController::class, 'createSampleOffer'])->name('create-sample-offer');
Route::get('create-sample-offers', [OfferController::class, 'createSampleOffersFromJSON']);

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
    $user->name = 'Vater';
    $user->email = 'vater@muetter.cz';
    $user->password = 'dinimuetter';
    $user->save();

    $account = new Account();
    $account->fk_communityID = $community->getKey();
    $account->fk_userID = $user->getKey();
    $account->firstname = 'Vater';
    $account->lastname = 'God';
    $account->save();
});

require __DIR__ . '/auth.php';
