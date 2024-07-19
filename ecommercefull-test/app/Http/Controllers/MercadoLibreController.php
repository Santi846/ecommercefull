<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
// use App\Models\UserToken;
use App\Models\User;
use App\Models\CustomerToken;
use App\Models\SellerToken;
use App\Models\Product;
use App\Models\Order;

class MercadoLibreController extends Controller
{
    private $client_id;
    private $client_secret;
    private $redirect_uri;
    private $code;

    public function __construct()
    {
        $this->client_id = env('MERCADO_LIBRE_CLIENT_ID');
        $this->client_secret = env('MERCADO_LIBRE_CLIENT_SECRET');
        $this->redirect_uri = env('MERCADO_LIBRE_REDIRECT_URI');
        $this->code = env('MERCADO_LIBRE_TG_CODE');
    }

    
    public function redirectToMercadoLibre()
    {
        $url = 'https://auth.mercadolibre.com.uy/authorization?response_type=code&client_id=' . $this->client_id . '&redirect_uri=' . $this->redirect_uri;
        return redirect($url);
    }

    
    public function authentication(){
        $apiInstance = new Meli\Api\OAuth20Api(
           
            new GuzzleHttp\Client()
        );

        $client_id = env('MERCADO_LIBRE_CLIENT_ID');
        $client_secret = env('MERCADO_LIBRE_CLIENT_SECRET');
        $redirect_uri = env('MERCADO_LIBRE_REDIRECT_URI');
        $code = env('MERCADO_LIBRE_TG_CODE');

        try {
            $result = $apiInstance->getToken($grant_type, $client_id, $client_secret, $redirect_uri, $code, $refresh_token);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling OAuth20Api->getToken: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function handleMercadoLibreCallbackSeller(Request $request)
{
    try {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.mercadolibre.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => '4758386807404546',
                'client_secret' => '5ok0GphAlzteXOAIO07L5lShXngDE0eY',
                'refresh_token' => 'TG-669576a286160a000170fa85-632351224'
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        
            if ($data) {
                

                    // SellerToken::create([
                    //         'access_token' => $data['access_token'],
                    //         'refresh_token' => $data['refresh_token'],
                    //         'expires_in' => $data['expires_in'],
                    //         ]);

                    SellerToken::first()->update($data);
               
            }

           
        return view('seller.blade.php', [
            'sellers' => $sellers,
        ]);
        
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error during Mercado Libre authentication: ' . $e->getMessage());
    }
}

public function handleMercadoLibreCallbackRefreshSeller(Request $request)
{
    try {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.mercadolibre.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => '4758386807404546',
                'client_secret' => '5ok0GphAlzteXOAIO07L5lShXngDE0eY',
                'refresh_token' => 'TG-669576a286160a000170fa85-632351224'
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
            if ($data) {
                    SellerToken::first()->update($data);
                    $sellers = SellerToken::all();
                    $products = Product::all();
                    return view('seller', ['sellers' => $sellers], ['products' => $products]);
                    // return view('seller', ['sellers' => $sellers]);
            }
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error during Mercado Libre authentication: ' . $e->getMessage());
    }
}

public function showSeller()
{
   $sellers = SellerToken::all();
   $products = Product::all();
    return view('seller', ['sellers' => $sellers], ['products' => $products]);

}


public function handleMercadoLibreCallbackCustomer(Request $request)
{
    try {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.mercadolibre.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => '4758386807404546',
                'client_secret' => '5ok0GphAlzteXOAIO07L5lShXngDE0eY',
                'refresh_token' => 'TG-669576a286160a000170fa85-632351224'
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
      
            if ($data) {
               
                    //customer creation///////////////////////////////////////////////
                    // CustomerToken::create([
                    //     'access_token' => $data['access_token'],
                    //     'refresh_token' => $data['refresh_token'],
                    //     'expires_in' => $data['expires_in'],
                    //     ]);

                  
                    CustomerToken::first()->update($data);
                
            }


        return redirect()->route('mercadolibre.showToken')->with('success', 'Successfully authenticated with Mercado Libre');
        
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error during Mercado Libre authentication: ' . $e->getMessage());
    }
}

public function handleMercadoLibreCallbackRefreshCustomer(Request $request)
{
    try {
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.mercadolibre.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => '4758386807404546',
                'client_secret' => '5ok0GphAlzteXOAIO07L5lShXngDE0eY',
                'refresh_token' => 'TG-669576a286160a000170fa85-632351224'
            ],
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
            if ($data) {
                    CustomerToken::first()->update($data);
                    $customers = CustomerToken::all();
                    $products = Product::all();
                    return view('customer', ['customers' => $customers], ['products' => $products]);

            }
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'Error during Mercado Libre authentication: ' . $e->getMessage());
    }
}



public function showTokenCustomer(){
   
        $customers = CustomerToken::all();
        $products = Product::all();
        $orderItems = Order::all();
        
        return view('customer', ['customers' => $customers], ['products' => $products], ['orderItems' => $orderItems]);
    
}


}