<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AuthenticatedController;
// base controller
use App\Http\Controllers\{
    PagesController,
};
use App\Http\Controllers\Users\{
    ProfilController,
    NotifikasiController,
    ProfilInvestorController 
};

use App\Http\Controllers\Investor\{
    ProfilPerusahaanController,
    DokumenPerusahaanController,
    InvestasiController,
    InvestorController
  
};

// umkm controller
use App\Http\Controllers\Umkm\{
    AccountController,
    FundingController,
    DashboardUMKMController,
    FinansialController,
    ProdukController,
    UsahaController,

    DashboardController as UmkmDashboardController
};

use App\Http\Controllers\Admin\{
    KegiatanController,
    UserController,
    JanjitemuController,
    InvestasiAdminController,
    InformasiController
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
    Route::prefix('account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/notifikasi', 'notifikasi');
    });
    Route::any('/beranda', [UmkmDashboardController::class, 'beranda']);
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

    // umkm dashboard route
    Route::prefix('dashboard')->controller(UmkmDashboardController::class)->group(function () {
        Route::prefix('funding')->controller(FundingController::class)->group(function () {
              Route::any('/', 'show_bisnis');
               Route::get('/{slug}', 'deskripsi_bisnis');
               Route::any('{slug}/daftar_investor/', 'list_investor_investasi');
                Route::any('{slug}/daftar_umkm/', 'list_funding_umkm');
              Route::any('{slug}/data_fundingku/', 'fundingku');
              Route::get('keluar/{slug}', 'leave_funding');
        });
        Route::any('/', 'index');
        Route::any('/beranda/{slug}', 'beranda');
        
        Route::prefix('kegiatanku')->group(function () {
            Route::any('/', 'kegiatanku');
            Route::any('/logbook/{slug}', 'umkmjurnal');
            Route::post('/tambah_eventual', 'tambah_eventual');
            Route::post('/edit_logbook','edit_logbook');
            Route::post('/buat_logbook','buat_logbook');
            Route::get('/{slug}', 'deskripsi');
            Route::any('/{slug}/elearning/', 'elearning');
            Route::any('/materi/{slug}', 'materi');
            Route::get('/eventual/{page}', 'eventual');
            Route::any('/materi_detail/{slug}/', 'detail_materi');
            Route::get('/keluar/{slug}', 'leave_kegiatan');
            Route::any('/tugas_akhir/{slug}', 'tugas_akhir');
            Route::post('/tugas_akhir', 'tugas_akhir_post');

     });
    
       //  Route::get('/kegiatanku/{page}/logbook', 'logbook');
        //  Route::get('/kegiatanku/{page}/eventual', 'eventual');
        Route::any('/janjitemu', 'janjitemu');
        
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
Route::prefix('admin/')->middleware(['auth','shouldAdmin'])->group(function () {
    // admin dashboard route
    Route::any('dashboard/', [DashboardController::class, 'index']);
    // admin kegiatan route
    
 
    Route::prefix('kegiatan')->controller(KegiatanController::class)->group(function () {
        Route::any('/', 'index');
        Route::post('/edit_deskripsi', 'edit_deskripsi');
        Route::any('/{slug}/tambah_elearning', 'tambah_elearning'); 
        Route::any('/{slug1}/eventual/', 'list_eventual');
        Route::any('/{slug1}/publikasi/', 'publikasi');
        Route::post('/ubah_status_publikasi/', 'ubah_status_kelulusan');
        Route::any('/{slug}/investor/', 'daftar_investor');
        Route::any('/{slug}/umkm/', 'daftar_umkm');
        Route::post('/hapus_kegiatan', 'hapus_kegiatan');
        Route::any('/{slug}/tugas_akhir', 'tugas_akhir');
        Route::post('/hapus_elearning', 'hapus_elearning');
        Route::post('/hapus_bab', 'hapus_bab');
        Route::post('{slug}/hapus_eventual', 'hapus_eventual');
        Route::post('/tambah_elearning', 'add_elearning');
        Route::any('/{slug}/elearning/','list_elearning');
        Route::any('/{slug}/detail', 'detail_kegiatan');
        Route::get('/{slug}/edit', 'edit_kegiatan');
        Route::get('/elearning/{slug}/edit', 'edit_elearning_view');
        Route::post('/elearning/edit', 'edit_elearning_post');
        Route::any('/elearning/{slug1}/bab/', 'list_bab');
        Route::any('/bab/{slug}/edit', 'edit_bab');
        Route::post('/bab/edit', 'edit_bab_post');
        Route::any('/{slug1}/tambah_bab', 'tambah_bab');
        Route::post('/tambah_bab', 'tambah_bab_post');
        Route::any('/{slug}/logbook/', 'list_logbook');
        Route::post('/logbook/ubah_status', 'ubah_status_logbook');
        Route::any('/{slug}/detail_logbook/{id}', 'list_user_logbook');
        Route::post('/edit_post', 'edit_kegiatan_post');
        Route::any('/tambah_kegiatan/','tambah');
        Route::post('/tambah_kegiatan','tambah_kegiatan_post');
        Route::post('/ubah_eventual_status', 'ubah_eventual_status');
        Route::post('/tambah_investor', 'tambah_investor_post');
        Route::post('/tambah_umkm', 'tambah_umkm_post');
        Route::post('/hapus_investor', 'hapus_investor');
        Route::post('/hapus_umkm', 'hapus_umkm');
        Route::post('/hapus_jawaban', 'hapus_jawaban');
        Route::post('/tambah_tugas_akhir', 'tambah_tugas');
         Route::post('/hapus_tugas_akhir', 'hapus_soal');

     
    });

       Route::any('janjitemu/',[JanjitemuController::class,'index']);
       Route::post('tambah_janji_temu/',[JanjitemuController::class,'create']);
       Route::any('tambah_janji_temu_view/',[JanjitemuController::class,'tambah_janji_temu_view']);
       Route::any('ubah_janji_temu_view/{slug}',[JanjitemuController::class,'edit_janji_temu_view']);
       Route::post('edit_janji_temu/',[JanjitemuController::class,'edit']);
       Route::post('hapus_janjitemu/',[JanjitemuController::class,'delete']);
       Route::any('investasi/',[InvestasiAdminController::class,'index']);


    Route::prefix('investasi')->controller(InvestasiAdminController::class)->group(function () {
         Route::get('/tambah_investasi',[InvestasiAdminController::class,'tambah_investasi']);
         Route::post('/hapus_investasi',[InvestasiAdminController::class,'hapus_investasi']);
          Route::post('/tambah_investasi_post',[InvestasiAdminController::class,'tambah_investasi_post']);
       Route::get('/{slug}/detail',[InvestasiAdminController::class,'detail_investasi']);
       Route::post('/submit_record_investor',[InvestasiAdminController::class,'tambah_investasi_investor']);
       Route::post('/edit_record_investor',[InvestasiAdminController::class,'edit_investasi_investor_post']);
       Route::post('/edit_record_umkm',[InvestasiAdminController::class,'edit_umkm_funding_post']);
        Route::post('/submit_record_umkm',[InvestasiAdminController::class,'tambah_funding_umkm']);
       Route::any('/{slug}/investor_investasi',[InvestasiAdminController::class,'list_investor_investasi']);
        Route::any('/{slug}/umkm_funding',[InvestasiAdminController::class,'list_umkm_funding']);
       Route::any('/{slug}/investor',[InvestasiAdminController::class,'daftar_investor']);
       Route::any('/{slug}/umkm',[InvestasiAdminController::class,'daftar_umkm']);
       Route::post('/hapus_investasi_investor',[InvestasiAdminController::class,'hapus_investasi_investor_post']);
       Route::post('/hapus_funding_umkm/',[InvestasiAdminController::class,'hapus_funding_umkm_post']);
       Route::any('/{slug}/detail_investasi/{slug2}',[InvestasiAdminController::class,'investor_investasi_detail']);
        Route::any('/{slug}/detail_funding/{slug2}',[InvestasiAdminController::class,'umkm_funding_detail']);
       Route::post('/hapus_investor',[InvestasiAdminController::class,'hapus_investor']);
       Route::post('/tambah_investor',[InvestasiAdminController::class,'tambah_investor_post']);
       Route::post('/tambah_umkm',[InvestasiAdminController::class,'tambah_umkm_post']);
       Route::post('/hapus_umkm/',[InvestasiAdminController::class,'hapus_umkm']);
       Route::get('/{slug}/edit',[InvestasiAdminController::class,'edit_investasi']);
      Route::post('investasi/edit_post',[InvestasiAdminController::class,'edit_investasi_post']);
       Route::post('/edit_post',[InvestasiAdminController::class,'edit_investasi_post']);
   });
     Route::prefix('info_admin')->controller(InvestasiAdminController::class)->group(function () {
         Route::any('/',[InformasiController::class,'daftar_informasi']);
         Route::post('/tambah_info',[InformasiController::class,'tambah_informasi']);
         Route::post('/tandai',[InformasiController::class,'tandai_informasi']);
         Route::post('/edit_info',[InformasiController::class,'edit_informasi']);
         Route::post('/hapus_info',[InformasiController::class,'hapus_informasi']);
   });
       
   Route::any('/pesan',[PagesController::class,'laporan_all']);

    Route::prefix('pengguna')->group(function () {
        Route::post('/ubah_password', [UserController::class, 'ubah_password']);
        Route::post('/tambah_user', [UserController::class, 'tambah_user']);
        Route::any('/{role}', [UserController::class, 'all']);
        Route::post('/user/hapus_user', [UserController::class, 'delete']);
    });
});

//Profil Khusus Investor
Route::prefix('investor/')->middleware(['auth','verified','shouldInvestor'])->group(function () {

Route::prefix('/profil/')->middleware(['auth','verified'])->group(function () {
    Route::get('1', [ProfilInvestorController::class, 'form_wizard_profil_pertama']);
    Route::get('2', [ProfilInvestorController::class, 'form_wizard_profil_kedua']);
    Route::get('3', [ProfilInvestorController::class, 'form_wizard_profil_ketiga']);
    Route::prefix('proses/')->group(function () {
        Route::post('wizard_pertama', [ProfilInvestorController::class, 'process_wizard_profil_pertama']);
        Route::post('wizard_kedua', [ProfilInvestorController::class, 'process_wizard_profil_kedua']);
        Route::post('wizard_ketiga', [ProfilInvestorController::class, 'process_wizard_profil_ketiga']);
    });
    });
    Route::any('/beranda', [InvestorController::class, 'beranda']);
    Route::prefix('dashboard/')->middleware(['auth','verified'])->group(function () {
        Route::any('/', [InvestorController::class, 'dashboard']);
        Route::any('janjitemu/', [InvestorController::class, 'janji_temu']);
        Route::prefix('kegiatan')->group(function () {
            Route::any('/', [InvestorController::class, 'kegiatan']);
            Route::any('/{slug}', [InvestorController::class, 'deskripsi']);
            Route::any('daftar_umkm/{slug}', [InvestorController::class, 'daftar_umkm']);
            Route::get('keluar/{slug}', [InvestorController::class, 'leave_kegiatan']);
            Route::any('{slug1}/logbook/{slug2}',[InvestorController::class,'logbook_umkm']);
            Route::any('{slug1}/laporan/{slug2}',[InvestorController::class,'tugas_akhir_umkm']);

           });
        Route::prefix('bisnisku')->group(function () {
            Route::any('daftar_umkm/{slug}',[InvestorController::class,'list_umkm']);
            Route::any('daftar_investor/{slug}',[InvestorController::class,'list_investor']);
            Route::any('investasi/{slug}',[InvestorController::class,'investasiku']);
            Route::get('/{slug}',[InvestorController::class,'deskripsi_bisnis']);
            Route::any('/',[InvestorController::class,'show_bisnis']);
            Route::get('keluar/{slug}',[InvestorController::class,'keluar_bisnis']);

        });

      
        Route::get('profil_perusahaan', [ProfilPerusahaanController::class, 'form_wizard_profil_perusahaan']);
        Route::get('dokumen_perusahaan', [DokumenPerusahaanController::class, 'form_wizard_dokumen_perusahaan']);
        Route::post('profil_perusahaan', [ProfilPerusahaanController::class, 'process_wizard']);
        Route::post('dokumen_perusahaan', [DokumenPerusahaanController::class, 'process_wizard']);
 });
     Route::any('janjitemu', [InvestorController::class, 'ajukan_janji_temu']);



});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    $request->session()->flash('success','Email berhasil dikirim ulang, harap cek inbox anda');
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return Inertia::render('Auth/Verification_success');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/halaman_verifikasi',function(Request $request){
    return Inertia::render('Auth/Confirmation_email',['request'=>$request->email]);
})->middleware(['auth']);

Route::get('/syarat_dan_ketentuan',function(){
    return Inertia::render('SyaratDanKetentuan');
})->middleware(['auth']);


Route::get('/panduan',function(){
    return Inertia::render('panduan');
});

Route::get('/contact',function(){
    return Inertia::render('Hubungi_kami');
});



Route::prefix('laporan/')->group(function () {
        Route::post('/',[PagesController::class,'laporan_post']);
        Route::post('/tandai',[PagesController::class,'tandai'])->middleware(['auth','shouldAdmin']);
        Route::post('/hapus',[PagesController::class,'hapus'])->middleware(['auth','shouldAdmin']);

});



Route::get('/about',function(){
    return Inertia::render('Tentang_program');
});



Route::get('/kebijakan_dan_privasi',function(){
    return Inertia::render('KebijakanPrivasi');
});




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


Route::prefix('/detail/profil/')->middleware(['auth','verified','shouldAdmin'])->group(function () {
    Route::get('/umkm/{slug}', [ProfilController::class, 'detailUMKM']);
    Route::get('/investor/{slug}', [ProfilController::class, 'detailInvestor']);
    Route::post('/{slug}/{slug1}/beri_tanggapan', [UserController::class, 'beri_tanggapan']);
    Route::get('/{slug}/{slug1}/accept', [UserController::class, 'terima_user']);
    Route::get('/{slug}/hapus', [UserController::class, 'delete']);

});

Route::prefix('/notifikasi/')->middleware(['auth','verified'])->group(function () {
    Route::any('UMKM', [NotifikasiController::class, 'show'])->middleware(['shouldUmkm']);
    Route::any('admin', [NotifikasiController::class, 'show'])->middleware(['shouldAdmin']);
    Route::any('Investor', [NotifikasiController::class, 'show'])->middleware(['shouldInvestor']);
    Route::post('hapus_notif/', [NotifikasiController::class, 'delete']);
    Route::post('tandai_notif/', [NotifikasiController::class, 'tandai_notif']);
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



