<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealRequest;

class DealController extends Controller
{
	public function store(DealRequest $request)
	{
    	$request->validated();
	}
}
