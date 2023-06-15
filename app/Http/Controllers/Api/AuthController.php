<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController as Controller;
use Illuminate\Http\Request;
use App\Services\Zoho\Authentication\FetchAccessToken;
use App\Services\Zoho\Authentication\RefreshAccessToken;

class AuthController extends Controller
{
	public function callback(Request $request)
	{
    $code = $request->query('code');

    $fetchAccessTokenService = new FetchAccessToken();

    $response = $fetchAccessTokenService->perform($code);

    $access_token = $response['access_token'];
    $refresh_token = $response['refresh_token'];
    $access_token_created_at = $response['created_at'];

    return response()->view('welcome', compact('access_token', 'refresh_token', 'access_token_created_at'));
  }

  public function refreshToken(Request $request) {
    $refreshToken = $request->header('Refresh-Token');

    $service = new RefreshAccessToken();

    $response = $service->perform($refreshToken);

    if (!isset($response['access_token'])) {
      return response()->json([
        'message' => 'Error',
        'data' => $response,
      ], 400);
    }

    $data = [
      "new_access_token" => $response['access_token'],
      "new_access_token_created_at" => $response['created_at']
    ];

    return response()->json([
      'message' => 'Success',
      'data'  => $data,
    ], 200);
  }
}
