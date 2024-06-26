<?php

use App\Models\Account;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sample-offers/{communityID}', function ($communityID) {
    return Offer::where('fk_ownerID', Account::where('fk_communityID', $communityID)->get()->modelKeys())->get();
});
