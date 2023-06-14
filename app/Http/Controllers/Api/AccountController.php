<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccountRequest;
use App\Http\Controllers\Api\ApiController as Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
	public function store(AccountRequest $request): JsonResponse
	{
    $validated = $request->validated();

    return response()->json([
      'message' => 'Success',
      'data' => ['testing' => $validated],
    ], 200);
  }
}
