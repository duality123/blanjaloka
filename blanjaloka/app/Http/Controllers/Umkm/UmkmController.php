<?php
namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bisnis;
use App\Models\Notifikasi;
use App\Models\DokumenPerusahaan;
use App\Models\Janjitemu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class UmkmController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil diri terlebih dahulu']);
        }
        $roles = DB::table('roles')->select('user_id')->where('number','=',3)->get();
        $investor= [];
        foreach ($roles as $role) {
            $target = DB::table('profil')->select('nama_lengkap','no_hp')->where('user_id','=',$role->user_id)->first();
        
            $investor[] = $target->nama_lengkap . '/' . $target->no_hp ;
        }
        DB::table('janji_temu')->select('waktu','lokasi','status')->where('umkm_id','=',$request->id)->first();
        $items = DB::table('janji_temu')
                ->join('profil', 'janji_temu.investor_id' , '=', 'profil.user_id')
                ->select('janji_temu.lokasi', 'janji_temu.status', 'janji_temu.waktu','profil.nama_lengkap')
                ->where('janji_temu.umkm_id','=',$request->user()->id)
                ->get(); 
        return Inertia::render('Umkm/Dashboard/JanjiTemu',['investor'=>$investor,'items'=>$items]);
    }


    public function create(Request $request)
    {
        if(!$request->user()->accepted){
               return Inertia::render('Profil/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil diri terlebih dahulu']);
        }
        //dd($request->all());

         $rules = [
            'lokasi' => 'required|max:100',
            'waktu' => 'required',
            'nama_investor'=>'required'
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

      $this->validate($request, $rules, $customMessages);
      $investor = $request->post('nama_investor')[0];
      $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
      $kegiatan = Janjitemu::create(['lokasi' => $request->post('lokasi'),
                                    'temp_target' => $target->user_id,
                                    'waktu'=> $request->post('waktu'),
                                    'status'=>0,
                                    'investor_id'=>$request->user()->id]);
      $request->session()->flash('success','Janji temu berhasil di request');

      return back();
    }


}