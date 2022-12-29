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
use App\Models\Profil;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class JanjitemuController extends Controller
{

    public function index(Request $request){
        $data = Janjitemu::select('temp_target','investor_id','umkm_id','lokasi','waktu','id','berakhir')->paginate(10);
        
    
        for ($i=0; $i < count($data); $i++) { 
           $investor_name = Profil::select('nama_lengkap')->where('user_id','=', $data[$i]->investor_id)->first();
           $umkm_name = Profil::select('nama_lengkap')->where('user_id','=', $data[$i]->umkm_id)->first();
           $data[$i]->nama_investor = $investor_name->nama_lengkap;
           $data[$i]->nama_umkm = $umkm_name->nama_lengkap;
           
        }

        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
             $investor[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) {        
            $umkm[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
        
        return Inertia::render('Dashboard/Temu_janji',['items'=>$data,'umkm'=>$umkm,'investor'=>$investor]);
    }


    public function create(Request $request)
    {
     
        //dd($request->all());

        $rules = [
            'lokasi' => 'required|max:100',
            'dimulai' => 'required',
            'umkm'=>'required',
            'berakhir' =>'required',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $umkm = $request->post('umkm')[0];
      $investor = $request->post('investor')[0];
      $targetUMKM = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$umkm)[1])->first();
      $targetInvestor = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
      $kegiatan = Janjitemu::create(['lokasi' => $request->post('lokasi'),
                                    'umkm_id' => $targetUMKM->user_id,
                                    'waktu'=> $request->post('dimulai'),
                                    'berakhir'=>$request->post('berakhir'),
                                    'investor_id'=>$targetInvestor->user_id]);
      $request->session()->flash('success','Janji temu berhasil di request');

      return back();
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
