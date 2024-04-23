<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/testRequest/{testID}', function (Request $request, $testID) {
    return [
        'message' => "You request the offers of $testID and your request was {$request->get('requestText')}",
    ];
});
