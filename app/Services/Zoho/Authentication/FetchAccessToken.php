<?php

namespace App\Services\Zoho\Authentication;

use Illuminate\Support\Facades\Http;
use App\Services\Zoho\Modules\Base;
use Carbon\Carbon;

class FetchAccessToken extends Base
{
  public function __construct()
  {
    parent::__construct();
  }

  public function perform($code) {
    return $this->connect($code);
  }

  private function connect($code)
  {
    $url = $this->accountsBaseUrl . '/token';

    $payload = [
      'client_id' => env("ZOHO_CLIENT_ID"),
      'client_secret' => env("ZOHO_CLIENT_SECRET"),
      'redirect_uri' => env("ZOHO_REDIRECT_URL"),
      'grant_type' => 'authorization_code',
      'code' => $code,
    ];

    $response = $this->postFormRequest($url, $payload);
    $parsedResponse = $response->json();
    $parsedResponse['created_at'] = Carbon::now();

    return $parsedResponse;
  }
}
