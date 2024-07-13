<?php

namespace App\Services;

use GuzzleHttp\Client;

class MercadoLibreService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.mercadolibre.com/',
        ]);
    }

    public function getAccessToken($code)
    {
        $response = $this->client->post('oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => env('MERCADO_LIBRE_CLIENT_ID'),
                'client_secret' => env('MERCADO_LIBRE_CLIENT_SECRET'),
                'code' => $code,
                'redirect_uri' => env('MERCADO_LIBRE_REDIRECT_URI'),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getUserInfo($accessToken)
    {
        $response = $this->client->get('users/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    // Add more methods as needed for other API endpoints
}
