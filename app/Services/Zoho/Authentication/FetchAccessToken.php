<?php

namespace App\Services\Zoho\Authentication;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class FetchAccessToken
{
    private $url;
    private $params;

    public function __construct()
    {
      $this->url = "https://accounts.zoho.com/oauth/v2/token";
      $this->params = [
        'client_id' => env("ZOHO_CLIENT_ID"),
        'client_secret' => env("ZOHO_CLIENT_SECRET"),
        'redirect_uri' => env("ZOHO_REDIRECT_URL"),
        'grant_type' => 'authorization_code',
      ];
    }

    public function perform($code) {
        return $this->connect($code);
    }

    private function connect($code)
    {
      $this->params['code'] = $code;

      $response = $this->makeRequest();
      Session::forget('Tokens');
      Session::pull('Tokens');
      $parsedResponse = $response->json();
      $parsedResponse['created_at'] = Carbon::now();
      Session::put('Tokens', $parsedResponse);
      Session::put('time', Carbon::now()->format("H:i:s"));
      return $parsedResponse;
    }

    private function makeRequest()
    {
      return Http::asForm()->post($this->url, $this->params);
    }
}
