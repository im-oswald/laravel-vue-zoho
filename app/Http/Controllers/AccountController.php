<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;

class AccountController extends Controller
{
	public function store(AccountRequest $request)
	{
    	$request->validated();
	}
}
