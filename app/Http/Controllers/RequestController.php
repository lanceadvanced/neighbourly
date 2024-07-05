<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public static function getOffersFromRequest($request, $communityID)
    {
        $response = Http::post(env('NEIGHBOURLY_API'), [
            'community_id' => $communityID,
            'requested_service' => $request
        ]);

        return $response->json();
    }

    public static function getOffersByCommunity($communityID): JsonResponse
    {
        if(empty($communityID)){
            abort(500, 'No community ID provided');
        }

        return response()->json(OfferController::getOffersByCommunity($communityID));
    }
}
