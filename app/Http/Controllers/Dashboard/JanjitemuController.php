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
use App\Models\Janjitemu;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class JanjitemuController extends Controller
{

    public function index(Request $request,$page){
        $data = DB::table('janji_temu')->select('temp_target','investor_id','umkm_id','lokasi','waktu','status','id')->get();
    
        for ($i=0; $i < count($data); $i++) { 
           $investor_name = DB::table('profil')->select('nama_lengkap')->where('user_id','=', $data[$i]->investor_id)->first();
           $umkm_name = DB::table('profil')->select('nama_lengkap')->where('user_id','=', $data[$i]->umkm_id)->first();
           $data[$i]->nama_investor = $investor_name->nama_lengkap;
           $data[$i]->nama_umkm = $umkm_name->nama_lengkap;
           
        }
        return Inertia::render('Dashboard/Temu_janji',['items'=>$data]);
    }
      public function delete(Request $request){
        $data = Janjitemu::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Janji temu berhasil dihapus');
        return back();
    }

     public function changeState(Request $request){;
        $data = Janjitemu::where('id','=',$request->post('id'))->update(['status'=>$request->post('update')]);
        $request->session()->flash('success','Janji temu berhasil diupdate');
        return back();
    }

    


}
