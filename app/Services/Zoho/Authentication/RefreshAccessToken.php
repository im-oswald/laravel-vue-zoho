<?php

namespace App\Services\Zoho\Authentication;

use Illuminate\Support\Facades\Http;
use App\Services\Zoho\Modules\Base;
use Carbon\Carbon;

class RefreshAccessToken extends Base
{
  public function __construct()
  {
    parent::__construct();
  }

  public function perform($refreshToken) {
    return $this->connect($refreshToken);
  }

  private function connect($refreshToken)
  {
    $url = $this->accountsBaseUrl . '/token';

    $payload = [
      'refresh_token' => $refreshToken,
      'client_id' => env("ZOHO_CLIENT_ID"),
      'client_secret' => env("ZOHO_CLIENT_SECRET"),
      'redirect_uri' => env("ZOHO_REDIRECT_URL"),
      'grant_type' => 'refresh_token',
      'scope' => env("ZOHO_SCOPE")
    ];

    $response = $this->postFormRequest($url, $payload);

    $parsedResponse = $response->json();
    $parsedResponse['created_at'] = Carbon::now();

    return $parsedResponse;
  }
}
