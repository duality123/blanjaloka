<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kegiatan;
use App\Models\Elearning;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Logbook;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class PublikasiController extends Controller
{

   public function index($id){
    $data = Kegiatan::publikasi($id);

    $kegiatan = DB::table('kegiatan')->select('tema','id','mentor','juri')->where('id','=',$id)->first();
    $investorid = DB::table('kegiatan_investor')->select('kegiatan_investor.investor_id')->where('kegiatan_investor.kegiatan_id','=',$id)->get();
   
    $profilInvestor ='';
    foreach ($investorid as $invest) {
      $nama_investor = DB::table('profil')->select('nama_lengkap')->where('user_id','=',$invest->investor_id)->first();

        $profilInvestor  = $profilInvestor . ','.$nama_investor->nama_lengkap;
    }
    return Inertia::render('Dashboard/Kegiatan/Publikasi',['items'=>$data['items'],
                                                           'kegiatan'=>$kegiatan,
                                                           'investor'=>$profilInvestor]);
  
  }



    


}
