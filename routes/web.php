<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\Dashboard\KegiatanController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\UMKM\UsahaController;
use App\Http\Controllers\UMKM\ProdukController;
use App\Http\Controllers\UMKM\FinansialController;
use App\Http\Controllers\Users\NotifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UMKM\DashboardUMKMController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Users\ProfilController;
// use App\Http\Controllers\AuthenticatedController;

// base controller
use App\Http\Controllers\{
    PagesController,
};

use App\Http\Controllers\Investor\{
    ProfilPerusahaanController,
    DokumenPerusahaanController,
    DashboardController as InvestorDashboardController
};

// umkm controller
use App\Http\Controllers\UMKM\{
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
Route::prefix('umkm')->middleware(['auth','verified','shouldUmkm'])->group(function () {
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
            Route::get('/', 'kegiatanku');
            Route::get('/logbook/{slug}', 'umkmjurnal');
            Route::post('/tambah_eventual', 'tambah_eventual');
            Route::post('/edit_logbook','edit_logbook');
            Route::post('/buat_logbook','buat_logbook');
            Route::get('/detail/{slug}', 'deskripsi');
            Route::get('/{slug}/elearning/', 'elearning');
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
            Route::get('/', [UsahaController::class, 'form_wizard']);
            Route::post('/', [UsahaController::class, 'process_form_wizard']);
        });
        Route::prefix('profil_produk/')->group(function () {
                Route::get('/', [ProdukController::class, 'form_wizard']);
                Route::post('/', [ProdukController::class, 'process_form_wizard']);
            
        });
        Route::prefix('kajian_finansial/')->group(function () {
            Route::get('/', [FinansialController::class, 'form_wizard']);
            
            Route::post('/', [FinansialController::class, 'process_form_wizard']);
      
        });
    



    });





});
 
// admin route
Route::prefix('admin/dashboard')->middleware(['auth','shouldAdmin'])->group(function () {
    // admin dashboard route
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/detail/profil/{slug}/hapus', [UserController::class, 'delete']);
    // admin kegiatan route
    Route::prefix('kegiatan')->controller(KegiatanController::class)->group(function () {
        Route::post('/edit_deskripsi', 'edit_deskripsi');
        Route::get('/{id}/tambah_elearning', 'tambah_elearning');
        Route::get('/{slug1}/eventual/', 'list_eventual');
        Route::post('/hapus_kegiatan', 'hapus_kegiatan');
        Route::post('/hapus_elearning', 'hapus_elearning');
        Route::post('/hapus_bab', 'hapus_bab');
        Route::post('{slug}/hapus_eventual', 'hapus_eventual');
        Route::post('/tambah_elearning/baru', 'add_elearning');
        Route::get('/', 'index');
        Route::get('/{slug}/elearning/','list_elearning');
        Route::get('/{slug}/detail', 'detail_kegiatan');
        Route::get('/{slug}/edit', 'edit_kegiatan');
        Route::get('/elearning/{slug}/edit', 'edit_elearning_view');
        Route::post('/elearning/edit', 'edit_elearning_post');
        Route::get('/elearning/{slug1}/detail/', 'list_bab');
        Route::get('/elearning/bab/{slug}/edit', 'edit_bab');
        Route::post('/elearning/bab/edit', 'edit_bab_post');
        Route::get('/elearning/{slug1}/tambah_bab', 'tambah_bab');
        Route::post('/tambah_bab/baru', 'tambah_bab_post');
        Route::get('/{slug}/logbook/', 'list_logbook');
        Route::post('/logbook/ubah_status', 'ubah_status_logbook');
        Route::get('/{slug}/detail_logbook/{id}', 'list_user_logbook');
        Route::post('/edit_post', 'edit_kegiatan_post');
        Route::get('/{slug}/detail/elearning/{slug2}', 'list_elearning');
        Route::get('/tambah_kegiatan/baru/','tambah');
        Route::post('/tambah_kegiatan','add');
        Route::post('/ubah_eventual_status', 'ubah_eventual_status');
    });


    Route::prefix('pengguna')->group(function () {
        Route::get('/{role}', [UserController::class, 'all']);
        Route::post('hapus_user', [UserController::class, 'delete']);
    });
});

//Profil Khusus Investor
Route::prefix('investor/')->middleware(['auth','verified','shouldInvestor'])->group(function () {
    Route::get('/', [InvestorDashboardController::class, 'index']);
    Route::prefix('dashboard/')->middleware(['auth','verified'])->group(function () {
        Route::get('profil_perusahaan', [ProfilPerusahaanController::class, 'form_wizard_profil_perusahaan']);
        Route::get('dokumen_perusahaan', [DokumenPerusahaanController::class, 'form_wizard_dokumen_perusahaan']);

        Route::post('profil_perusahaan', [ProfilPerusahaanController::class, 'process_wizard']);
        Route::post('dokumen_perusahaan', [DokumenPerusahaanController::class, 'process_wizard']);
 });

});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    $request->session()->flash('success','Email berhasil dikirim ulang, harap cek inbox anda');
    return back();
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


Route::get('/role',function(){
    return Inertia::render('Auth/Pilih_role');
})->middleware('auth','no_role');



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



Route::get('/detail/profil/{slug}', [ProfilController::class, 'detailUMKM']);
Route::post('/detail/profil/{slug}/beri_tanggapan', [UserController::class, 'beri_tanggapan']);
Route::get('/detail/profil/{slug}/accept', [UserController::class, 'terima_user']);
Route::prefix('/profil/')->middleware(['auth','verified'])->group(function () {
    Route::get('1', [ProfilController::class, 'form_wizard_profil_pertama']);
    Route::get('2', [ProfilController::class, 'form_wizard_profil_kedua']);
    Route::get('3', [ProfilController::class, 'form_wizard_profil_ketiga']);
    Route::prefix('proses/')->group(function () {
        Route::post('wizard_pertama', [ProfilController::class, 'process_wizard_profil_pertama']);
        Route::post('wizard_kedua', [ProfilController::class, 'process_wizard_profil_kedua']);
        Route::post('wizard_ketiga', [ProfilController::class, 'process_wizard_profil_ketiga']);
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
