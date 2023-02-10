<?php

namespace App\Http\Controllers\Admin;
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

   public function index($slug){
    $data=DB::table('kegiatan')->select('slug','tema','juri','mentor')->where('slug','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $items =Profil::
                join('kegiatan_umkm','profil.user_id','=','kegiatan_umkm.umkm_id')
                ->select('foto_profil','nama_lengkap','user_id','no_hp','lulus_funding')
                ->where('kegiatan_umkm.kegiatan_id',$slug)
                ->orderBy('nama_lengkap','asc')->filter(request(['cari']))->paginate(10);
         return Inertia::render('Dashboard/Kegiatan/Publikasi',['items'=>$items,'bisnis'=>$data]);
  
  }

  public function ubah_status_kelulusan(Request $request){
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $status = DB::table('kegiatan_umkm')->select('lulus_funding')->where('slug',$request->post('slug')->where('umkm_id',$request->post('user_id'));
          
         if ($status->first()->lulus_funding) {
           $status->update(['lulus_funding','=',false]);
         }
         else{
            $status->update(['lulus_funding','=',true]);
         }
         return Inertia::render('Dashboard/Kegiatan/Publikasi',['items'=>$items,'bisnis'=>$data]);
  
  }




    


}
