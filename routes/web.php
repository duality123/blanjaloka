<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\Kegiatan\KegiatanController;
use App\Http\Controllers\Dashboard\Pengguna\AdminController as PenggunaAdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/kebijakan', function () {
    return Inertia::render('Kebijakan/Index');
});
Route::get('/syarat', function () {
    return Inertia::render('Syarat/Index');
});

Route::get('admin/login', function () {
    return Inertia::render('Auth/Login');
});


// Email verification
Route::prefix('email')->group(function () {
    Route::get('/verify', function () {
        return Inertia::render('Auth/Confirmation_email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/email/verify/success');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::get('/verify/success', function () {
        return Inertia::render('Auth/EmailSuccess');
    })->middleware('verified');

    Route::post('/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});



Route::group(['prefix' => 'dashboard', 'middleware' => ['role:admin'], 'auth'], function () {
    // kegiatan
    Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
    Route::get('kegiatan/tambah', [KegiatanController::class, 'create'])->name('kegiatan.create');

    // Pengguna (Admin)
    Route::get('pengguna/admin', [PenggunaAdminController::class, 'index'])->name('pengguna.admin.index');
    Route::post('pengguna/admin', [PenggunaAdminController::class, 'store'])->name('pengguna.admin.store');
    Route::delete('pengguna/admin/{id}', [PenggunaAdminController::class, 'destroy'])->name('pengguna.admin.delete');
    Route::put('pengguna/admin/{id}', [PenggunaAdminController::class, 'update'])->name('pengguna.admin.update');
    Route::get('pengguna/admin/{id}/edit', [PenggunaAdminController::class, 'edit'])->name('pengguna.admin.edit');
});




// Route::get('/authenticated_page', [AuthenticatedController::class, 'auth_page'])->middleware(['auth', 'verified'])->name('authenticated_page');


Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/{provider}/redirect', 'redirectToProvider')->name('provider.redirect');
    Route::get('/{provider}/callback', 'providerCallback')->name('provider.callback');
});

//route to facebook

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
