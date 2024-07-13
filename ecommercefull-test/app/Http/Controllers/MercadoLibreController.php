<?php

namespace App\Http\Controllers;

use App\Services\MercadoLibreService;
use Illuminate\Http\Request;

class MercadoLibreController extends Controller
{
    protected $mercadoLibreService;

    public function __construct(MercadoLibreService $mercadoLibreService)
    {
        $this->mercadoLibreService = $mercadoLibreService;
    }

    public function authenticate(Request $request)
    {
        // Redirect the user to Mercado Libre's OAuth page
        return redirect()->away('https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=' . env('MERCADO_LIBRE_CLIENT_ID') . '&redirect_uri=' . env('MERCADO_LIBRE_REDIRECT_URI'));
    }

    public function callback(Request $request)
    {
        $code = $request->get('code');
        $accessTokenData = $this->mercadoLibreService->getAccessToken($code);
        $accessToken = $accessTokenData['access_token'];

        // Store the access token in the session or database as needed
        // Retrieve user info
        $userInfo = $this->mercadoLibreService->getUserInfo($accessToken);

        return response()->json($userInfo);
    }
}
