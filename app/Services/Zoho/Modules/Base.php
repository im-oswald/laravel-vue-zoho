<?php

namespace App\Services\Zoho\Modules;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Base
{
    protected $accessToken;
    protected $baseUrl;

    public function __construct($accessToken)
    {
      $this->accessToken = $accessToken;
      $this->baseUrl = env('ZOHO_CRM_API_BASE_URL');
    }

    protected function postRequest($url, $payload, $headers)
    {
      return Http::withHeaders($headers)->post($url, $payload);
    }
}
