<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DealController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Account
Route::post('/account', [AccountController::class, 'store'])->name('account.create');

// Auth Callback
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::post('/token/refresh', [AuthController::class, 'refreshToken'])->name('auth.refreshToken');
