<?php

namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardUMKMController extends Controller
{
    public function index()
    {
        return Inertia::render('Profil/UMKM/Dashboard',['test'=>'test']);
    }



    public function kegiatanku(Request $request)
    {

        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
        $target = DB::table('kegiatan_umkm')->select('kegiatan_id')->where('umkm_id','=',$request->user()->id);
   
        return Inertia::render('Profil/UMKM/Kegiatanku',['test'=>'test']);
    }
}
