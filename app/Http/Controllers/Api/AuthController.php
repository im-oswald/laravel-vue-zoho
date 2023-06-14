<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Zoho\Authentication\FetchAccessToken;

class AuthController extends Controller
{
	public function callback(Request $request)
	{
    $code = $request->query('code');

    $fetchAccessTokenService = new FetchAccessToken();

    $data = $fetchAccessTokenService->perform($code);

    $access_token = $data['access_token'];
    $refresh_token = $data['refresh_token'];
    $access_token_created_at = $data['created_at'];

    return response()->view('welcome', compact('access_token', 'refresh_token', 'access_token_created_at'));
  }
}
