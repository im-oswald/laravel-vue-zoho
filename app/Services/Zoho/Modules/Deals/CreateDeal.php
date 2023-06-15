<?php

namespace App\Services\Zoho\Modules\Deals;

use Illuminate\Support\Facades\Http;
use App\Services\Zoho\Modules\Base;

class CreateDeal extends Base
{
  public function __construct($accessToken)
  {
    parent::__construct($accessToken);
  }

  public function perform($dealName, $stage, $accountName, $accountId) {
    return $this->createDeal($dealName, $stage, $accountName, $accountId);
  }

  private function createDeal($dealName, $stage, $accountName, $accountId)
  {
    $url = $this->baseUrl . '/Deals';

    $headers = [
      'Authorization' => 'Zoho-oauthtoken ' . $this->accessToken,
    ];

    $payload = [
      'data' => [
        [
          'Deal_Name' => $dealName,
          'Stage' => $stage,
          'Account_Name' => $accountName,
          'Account_ID' => $accountId,
        ],
      ],
    ];

    $response = $this->postRequest($url, $payload, $headers);

    return $response->json();
  }
}
