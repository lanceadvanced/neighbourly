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

});

Route::get('test-client', [TestClientController::class, 'viewTestClient'])->name('test-client');
Route::post('send-test-request', [TestClientController::class, 'sendTestRequest'])->name('send-test-request');
Route::get('delete-sample-offer/{offerID}', [OfferController::class, 'deleteSampleOffer'])->name('delete-sample-offer');
Route::post('create-sample-offer', [OfferController::class, 'createSampleOffer'])->name('create-sample-offer');

require __DIR__ . '/auth.php';
