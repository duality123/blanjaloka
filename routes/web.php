<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\Dashboard\KegiatanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\UMKM\ProfilController;
use App\Http\Controllers\UMKM\UsahaController;
use App\Http\Controllers\UMKM\ProdukController;
use App\Http\Controllers\UMKM\FinansialController;
use App\Http\Controllers\Users\NotifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UMKM\DashboardUMKMController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AuthenticatedController;

// base controller
use App\Http\Controllers\{
    PagesController,
};



// umkm controller
use App\Http\Controllers\Umkm\{
    AccountController,
    DashboardController as UmkmDashboardController
};
use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\User;
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
// set some variables

Route::get('/', [PagesController::class, 'home']);

// umkm route
Route::prefix('umkm')->middleware(['auth','verified'])->group(function () {
    // umkm account route

    Route::get('/join/{slug}', [UmkmDashboardController::class, 'join_kegiatan']);
    Route::prefix('account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/notifikasi', 'notifikasi');
    });

    // umkm dashboard route
    Route::prefix('dashboard')->controller(UmkmDashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/beranda/{slug}', 'beranda');
        
        Route::prefix('kegiatanku')->group(function () {
            Route::get('/{page}', 'kegiatanku');
              Route::get('/logbook/{slug}', 'umkmjurnal');
             Route::post('/tambah_eventual', 'tambah_eventual');
             Route::post('/tambah_logbook','tambah_logbook');
            Route::get('/detail/{slug}', 'deskripsi');
            Route::get('/{slug}/elearning/{page2}/', 'elearning');
            Route::get('/elearning/materi/overview/{slug}', 'materi');
            Route::get('/eventual/{$page}', 'eventual');
            Route::get('/elearning/materi/detail/{slug}/{page2}', 'detail_materi');
            Route::get('/keluar/{slug}', 'leave_kegiatan');
             Route::get('/eventual/{slug}', 'eventual');
     });
    
       //  Route::get('/kegiatanku/{page}/logbook', 'logbook');
        //  Route::get('/kegiatanku/{page}/eventual', 'eventual');
        Route::get('/janjitemu', 'janjitemu');
        Route::prefix('profil_usaha/')->group(function () {
            Route::get('1', [UsahaController::class, 'pertama']);
            Route::prefix('proses/')->group(function () {
                Route::post('pertama', [UsahaController::class, 'process_pertama']);
         });
        });
        Route::prefix('profil_produk/')->group(function () {
                Route::get('1', [ProdukController::class, 'pertama']);
                Route::prefix('proses/')->group(function () {
                    Route::post('pertama', [ProdukController::class, 'process_pertama']);
                }); 
            });
        Route::prefix('kajian_finansial/')->group(function () {
            Route::get('1', [FinansialController::class, 'pertama']);
            Route::prefix('proses/')->group(function () {
                Route::post('pertama', [FinansialController::class, 'process_pertama']);
            });
        });
    



    });





});
 
// admin route
Route::prefix('admin/dashboard')->middleware(['auth','can:view,App\Models\User'])->group(function () {
    // admin dashboard route
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/detail/profil/{slug}/hapus', [UserController::class, 'delete']);
    // admin kegiatan route
    Route::prefix('kegiatan')->controller(KegiatanController::class)->group(function () {
        Route::get('/{page}', 'index');
        Route::get('/tambah_kegiatan/baru/','tambah');
        Route::post('/tambah_kegiatan','add');
    });

    // admin pengguna route
    Route::prefix('pengguna')->group(function () {
        Route::get('/admin', [PenggunaController::class, 'admin']);
    });
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return Inertia::render('Auth/Confirmation_email');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return Inertia::render('Auth/Verification_success',['redirect'=>'/kebijakan_dan_privasi']);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/halaman_verifikasi',function(Request $request){
    return Inertia::render('Auth/Confirmation_email',['request'=>$request->email]);
})->middleware(['auth']);

Route::get('/syarat_dan_ketentuan',function(){
    return Inertia::render('SyaratDanKetentuan');
})->middleware('auth');


Route::get('/kebijakan_dan_privasi',function(){
    return Inertia::render('KebijakanPrivasi');
})->middleware('auth');


// Route::get('/authenticated_page', [AuthenticatedController::class, 'auth_page'])->middleware(['auth', 'verified'])->name('authenticated_page');


Route::controller(AuthController::class)->prefix('auth')->name('auth.')->group(function () {
    Route::get('/{provider}/redirect', 'redirectToProvider')->name('provider.redirect');
    Route::get('/{provider}/callback', 'providerCallback')->name('provider.callback');
});


Route::any('/ubah_password',[ProfilController::class,'ubah_password']);


Route::get('ubah_email',function(){
    return Inertia::render('Profil/Change_email');
})->middleware('auth');

Route::get('ubah_email/sukses',function(){
    return Inertia::render('Profil/Change_email_success');
})->middleware('auth');
/**
Route::get('reset_password',function(){
    return Inertia::render('Auth/Reset_password');
})->middleware('auth');

Route::get('reset_password/next',function(){
    return Inertia::render('Auth/Reset_password_next');
})->middleware('auth');

Route::get('reset_password/success',function(){
    return Inertia::render('Auth/Reset_password_success');
})->middleware('auth');
**/



Route::get('/detail/profil/{slug}', [ProfilController::class, 'detail']);
Route::post('/detail/profil/{slug}/beri_tanggapan', [UserController::class, 'beri_tanggapan']);
Route::get('/detail/profil/{slug}/accept', [UserController::class, 'terima_user']);
Route::prefix('/profil/')->middleware(['auth','verified'])->group(function () {
    Route::get('1', [ProfilController::class, 'pertama']);
    Route::get('2', [ProfilController::class, 'kedua']);
    Route::get('3', [ProfilController::class, 'ketiga']);
    Route::prefix('proses/')->group(function () {
        Route::post('pertama', [ProfilController::class, 'process_pertama']);
        Route::post('kedua', [ProfilController::class, 'process_kedua']);
        Route::post('ketiga', [ProfilController::class, 'process_ketiga']);
    });
 });

Route::prefix('/notifikasi/')->middleware(['auth','verified'])->group(function () {
    Route::get('{slug}', [NotifikasiController::class, 'show']);
    Route::get('hapus/{id}', [ProfilController::class, 'delete']);
 });



/*
Route::prefix('admin/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/kegiatan', [KegiatanController::class, 'index']);
     Route::post('/kegiatan', [KegiatanController::class, 'add']);
    Route::prefix('users/')->group(function () {
        //Route::get('{role}/{page}', [UserController::class, 'all']);
        Route::get('delete/{id}', [UserController::class, 'delete']);
        Route::get('accept/{id}', [UserController::class, 'terima_user']);
    });
});
*/


//Route::get('umkm/dashboard', [DashboardUMKMController::class, 'index']);


Route::get('umkm/kegiatanku', [DashboardUMKMController::class, 'kegiatanku']);



Route::get('/notifikasi/{role}/{slug}', [NotifikasiController::class, 'show']);
