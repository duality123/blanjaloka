<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\AuthenticatedController;

// base controller
use App\Http\Controllers\{
    PagesController,
    DashboardController
};

// admin controller
use App\Http\Controllers\Dashboard\{
    KegiatanController as AdminKegiatanController,
    PenggunaController as AdminPenggunaController
};

// umkm controller
use App\Http\Controllers\Umkm\{
    AccountController as UmkmAcountController,
    DashboardController as UmkmDashboardController,
    ProfileUsahaController as UmkmProfileUsahaController,
    ProfileProductController as UmkmProfileProductController,
    KajianFinansialController as UmkmKajianFinansialController,
    KegiatanController as UmkmKegiatanController
};

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



// Route::get('/', function () {
//     return view('/home');
// });

Route::get('/', [PagesController::class, 'home']);
Route::get('/kebijakan-privasi', [PagesController::class, 'kebijakanPrivasi']);
Route::get('/syarat-dan-ketentuan', [PagesController::class, 'syaratDanKetentuan']);

// umkm route
Route::prefix('umkm')->group(function () {
    // umkm account route
    Route::prefix('account')->controller(UmkmAcountController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/notifikasi', 'notifikasi');
    });

    // umkm dashboard route
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [UmkmDashboardController::class, 'index']);

        // umkm dashboard profile usaha
        Route::prefix('profile-usaha')->controller(UmkmProfileUsahaController::class)->group(function () {
            Route::get('/', 'index');
        });

        // umkm dashboard profile product
        Route::prefix('profile-product')->controller(UmkmProfileProductController::class)->group(function () {
            Route::get('/', 'index');
        });

        // umkm dashboard profile product
        Route::prefix('kajian-finansial')->controller(UmkmKajianFinansialController::class)->group(function () {
            Route::get('/', 'index');
        });

        // umkm dashboard kegiatan route
        Route::prefix('kegiatan')->controller(UmkmKegiatanController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{idKegiatan}', 'show');
        });
    });
});

// admin route
Route::prefix('admin/dashboard')->group(function () {
    // admin dashboard route
    Route::get('/', [DashboardController::class, 'index']);

    // admin kegiatan route
    Route::prefix('kegiatan')->controller(AdminKegiatanController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
    });

    // admin pengguna route
    Route::prefix('pengguna')->group(function () {
        Route::get('/admin', [AdminPenggunaController::class, 'admin']);
    });
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');



// Route::get('/authenticated_page', [AuthenticatedController::class, 'auth_page'])->middleware(['auth', 'verified'])->name('authenticated_page');


Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/{provider}/redirect', 'redirectToProvider')->name('provider.redirect');
    Route::get('/{provider}/callback', 'providerCallback')->name('provider.callback');
});

// Kode dibawah Akan dihapus dimasa depan
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
