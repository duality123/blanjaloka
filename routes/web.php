<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});


Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/google/redirect', 'oauthGoogleRedirect')->name('google.redirect');
    Route::get('/google/callback', 'oauthGoogleCallback')->name('google.callback');
});
