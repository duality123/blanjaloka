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
    return view('/home');
});
/**
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'register']);
Route::get('/page_konfirmasi/{id}',[AuthController::class,'page_konfirmasi'])->name('page_konfirmasi');
Route::get('/token_aktivasi/{token}',[AuthController::class,'tokenLinkVerify'])->name('tokenLinkVerify');
Route::post('/aktivasi',[AuthController::class,'tokenInputVerify'])->name('tokenInputVerify');
Route::post('/proses_konfirmasi',[AuthController::class,'proses_konfirmasi'])->name('konfirmasi');
Route::get('/reset_password',[AuthController::class,'resetPasswordPage'])->name('reset_password');
Route::get('/aktivasi/{token}',[AuthController::class,'tokenLinkVerify'])->name('tokenLinkVerify');
Route::post('/aktivasi',[AuthController::class,'tokenInputVerify'])->name('tokenInputVerify');
Route::post('/proses_konfirmasi',[AuthController::class,'proses_konfirmasi'])->name('konfirmasi');
 */
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/authenticated_page');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::get('/authenticated_page', [AuthenticatedController::class, 'auth_page'])->middleware(['auth', 'verified'])->name('authenticated_page');

Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/google/redirect', 'oauthGoogleRedirect')->name('google.redirect');
    Route::get('/google/callback', 'oauthGoogleCallback')->name('google.callback');
});
