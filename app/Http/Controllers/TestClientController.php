<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Http;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Session;

class TestClientController extends Controller
{

    public static function sendTestRequest(Request $request): Application|Redirector|ApplicationContract|RedirectResponse
    {
        $response = Http::post('http://ec2-13-50-246-182.eu-north-1.compute.amazonaws.com/postendpoint', [
            'requestText' => $request->get('requested-service')
        ]);

        return(redirect(route('test-client'))->with(
            [
                'requestInfo' => $request->all(),
                'response' => $response->json()
            ]
        ));
    }

    public static function viewTestClient(): Factory|Application|View|ApplicationContract
    {
        return view('testClient')->with([
            'requestInfo' => Session::get('requestInfo'),
            'response' => Session::get('response'),
            'sampleOffers' => Offer::all(),
        ]);
    }
}
