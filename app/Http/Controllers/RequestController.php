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
    public static function getOffersFromRequest(Request $request): Factory|Application|View|ApplicationContract
    {
        $response = Http::post(env('NEIGHBOURLY_API'), [
            'community_id' => 1,
            'requested_service' => $request->get('requested_service')
        ]);

        return view('artifacts.offerResults')->with('offers', $response->json());
    }

    public static function getOffersByCommunity($communityID): JsonResponse
    {
        if(empty($communityID)){
            abort(500, 'No community ID provided');
        }

        return response()->json(OfferController::getOffersByCommunity($communityID));
    }
}
