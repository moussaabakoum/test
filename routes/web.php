<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/post', function () {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://secure.paytabs.com/payment/request',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
    "profile_id": 107215,
    "tran_type": "auth",
    "tran_class": "ecom",
    "cart_description": "Description of the items/services",
    "cart_id": "11",
    "cart_currency": "AED",
    "cart_amount": 300,
    "tokenise": 2,
    "hide_shipping": true,
    "customer_details": {
        "name": "Walaa Elsaeed",
        "email": "w.elsaeed@paytabs.com",
        "phone": "0101111111",
        "street1": "test",
        "city": "Nasr City",
        "state": "Cairo",
        "country": "EG",
        "zip": "1234",
        "ip": "100.279.20.10"
    },
    "shipping_details": {
        "name": "Walaa Elsaeed",
        "email": "w.elsaeed@paytabs.com",
        "phone": "0101111111",
        "street1": "test",
        "city": "Nasr City",
        "state": "Cairo",
        "country": "EG",
        "zip": "1234",
        "ip": "100.279.20.10"
    },
    "callback": "https://test-ebbd72ce.devyzer.com/callback",
    "return": "https://test-ebbd72ce.devyzer.com/return"
}',
        CURLOPT_HTTPHEADER => array(
            'Authorization: S2JN6RT9JK-JGJLTHTZ6W-DH6LHDM26T',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    $res = json_decode($response);
    curl_close($curl);
    return Redirect::to($res->redirect_url);
//        dd($res->redirect_url);
});
Route::post('/return', function (Request $request) {
   dd($request);
});
Route::post('/callback', function (Request $request) {
   dd($request);
});

