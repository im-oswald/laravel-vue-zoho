<?php

namespace App\Services\Zoho\Modules\Accounts;

use Illuminate\Support\Facades\Http;
use App\Services\Zoho\Modules\Base;

class CreateAccount extends Base
{

  public function __construct($accessToken)
  {
    parent::__construct($accessToken);
  }

  public function perform($accountName, $accountWebsite, $accountPhone) {  
    return $this->createAccount($accountName, $accountWebsite, $accountPhone);
  }

  private function createAccount($accountName, $accountWebsite, $accountPhone)
  {
    $url = $this->baseUrl . '/Accounts';

    $headers = [
      'Authorization' => 'Zoho-oauthtoken ' . $this->accessToken,
    ];

    $payload = [
      'data' => [
        [
          'Account_Name' => $accountName,
          'website' => $accountWebsite,
          'Phone' => $accountPhone,
        ],
      ],
    ];

    $response = $this->postRequest($url, $payload, $headers);

    return $response->json();
  }
}
