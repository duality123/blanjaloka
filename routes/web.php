<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
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

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'register']);
Route::get('/page_konfirmasi/{id}',[AuthController::class,'page_konfirmasi'])->name('page_konfirmasi');
Route::get('/aktivasi/{token}',[AuthController::class,'tokenLinkVerify'])->name('tokenLinkVerify');
Route::post('/aktivasi',[AuthController::class,'tokenInputVerify'])->name('tokenInputVerify');
Route::post('/proses_konfirmasi',[AuthController::class,'proses_konfirmasi'])->name('konfirmasi');


Route::get('/authenticated_page',[AuthenticatedController::class,'auth_page'])->middleware(['auth','email_verified'])->name('authenticated_page');