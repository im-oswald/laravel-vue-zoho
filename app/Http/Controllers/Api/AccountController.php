<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Api\ApiController as Controller;
use Illuminate\Http\JsonResponse;
use App\Services\Zoho\Modules\Accounts\CreateAccount;
use App\Services\Zoho\Modules\Deals\CreateDeal;

class AccountController extends Controller
{
	public function store(AccountRequest $request): JsonResponse
	{
    $validated = $request->validated();

    $createAccountService = new CreateAccount($request->header('Access-Token'));

    $response = $createAccountService->perform(
      $validated['name'],
      $validated['website'],
      $validated['phone']
    );

    if (isset($response['data']['status']) && $response['data']['status'] === 'error') {
      return response()->json([
        'message' => 'Error',
        'data' => $response,
      ], 400);
    }

    if($response['data'][0]['code'] === 'SUCCESS') {
      $createDealService = new CreateDeal($request->header('Access-Token'));

      $response = $createDealService->perform(
        $validated['deal']['name'],
        $validated['deal']['stage'],
        $validated['name'],
        $response['data'][0]['details']['id']
      );
    }

    return response()->json([
      'message' => 'Success',
      'data' => $response,
    ], 200);
  }
}
