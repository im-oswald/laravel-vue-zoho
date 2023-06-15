<?php

namespace App\Services\Zoho\Modules;

use Illuminate\Support\Facades\Http;

class Base
{
  protected $accessToken;
  protected $baseUrl;
  protected $accountsBaseUrl;

  public function __construct($accessToken = null)
  {
    $this->accessToken = $accessToken;
    $this->baseUrl = env('ZOHO_CRM_API_BASE_URL');
    $this->accountsBaseUrl = env('ZOHO_AUTH_API_BASE_URL');
  }

  protected function postRequest($url, $payload, $headers)
  {
    return Http::withHeaders($headers)->post($url, $payload);
  }

  protected function postFormRequest($url, $payload)
  {
    return Http::asForm()->post($url, $payload);
  }
}
