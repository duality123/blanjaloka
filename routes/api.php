<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//oAuth
Route::get('auth/{provider}/redirect', [AuthController::class,'redirectToProvider']);
Route::get('auth/{provider}/callback', [AuthController::class,'providerCallback']);
Route::post('register', [UserController::class,'register']);

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
