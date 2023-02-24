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
use App\Models\Janjitemu;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use App\Models\Profil;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
class JanjitemuController extends Controller
{

    public function index(Request $request){
        $data = Janjitemu::with(['investor.profil:id,nama_lengkap,foto_profil,user_id','umkm.profil:id,nama_lengkap,foto_profil,user_id'])
            ->filter(request(['nama_investor','lokasi','nama_umkm','event_dimulai','event_berakhir','berakhir']))
            ->orderBy('waktu','asc')
            ->paginate(10);
            $limitUMKM = $request->get('limitUMKM') ? $request->get('limitUMKM') : 10;
            $umkm_all = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('roles','roles.user_id','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('users.accepted',true)
                         ->where('roles.number','=',2)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->limit($limitUMKM)->get();
                         
            
     /*
        $investor_all = User::where('accepted',true)
             ->whereRelation('role','number','=',3)->with(['profilPerusahaan:id,nama_perusahaan,kategori_perusahaan,user_id','profil:id,nama_lengkap,no_hp,foto_profil,user_id','role:id,number,user_id'])->select('id')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->orderBy(
              Profil::select('nama_lengkap')
              ->whereColumn('user_id', 'users.id')
              ->orderBy('nama_lengkap','asc')
              )
            ->paginate(10);

    */
          $limitInv = $request->get('limitInv') ? $request->get('limitInv') : 10;
          $investor_all = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('roles','roles.user_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->where('accepted',true)
            ->where('roles.number','=',3)
            ->orderBy('profil.nama_lengkap','asc')
            ->limit($limitInv)
            ->get();
        $countUMKM = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',2)->get()->count();
        $countInvestor = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',3)->get()->count();

        return Inertia::render('Dashboard/Temu_janji',['items'=>$data,
                                                       'umkm_all'=>Inertia::lazy(fn()=>$umkm_all),
                                                       'investor_all'=>Inertia::lazy(fn()=>$investor_all),
                                                       'countUMKM'=>Inertia::lazy(fn()=>$countUMKM),
                                                       'countInvestor'=>Inertia::lazy(fn()=>$countInvestor)

                                                   ]);
    }


    public function create(Request $request)
    {
     
        //dd($request->all());
        //dd($request->post('lokasi'));
        $rules = [
            'lokasi' => 'required|max:255',
            'dimulai' => 'required',
            'umkm'=>'required',
            'berakhir' =>'required',
            'investor' =>'required'      
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $umkm = $request->post('umkm');
      $investor = $request->post('investor');
      $kegiatan = Janjitemu::create(['lokasi' => $request->post('lokasi'),
                                    'umkm_id' => $umkm,
                                    'waktu'=> $request->post('dimulai'),
                                    'berakhir'=>$request->post('berakhir'),
                                    'investor_id'=>$investor]);
      $investor = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$investor);

      $umkm = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$umkm);

      Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Anda diundang untuk janji temu dengan investor '.$investor->first()->profil->nama_lengkap.' dilokasi '.$request->post('lokasi').' dimulai pada '.$request->post('dimulai'). ' dan berakhir pada '.$request->post('berakhir'),'redirect'=>'/umkm/dashboard/janjitemu?page=1','user_id'=>$umkm->first()->id,'waktu'=>now()]);

     $invNotif = $investor->first()->notifikasi;
     $investor->update(['notifikasi'=>$invNotif+1]);
     $umkmNotif = $umkm->first()->notifikasi;
     $umkm->update(['notifikasi'=>$umkmNotif+1]);

      Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Anda diundang untuk janji temu dengan UMKM '.$umkm->first()->profil->nama_lengkap.' dilokasi '.$request->post('lokasi').' dimulai pada '.$request->post('dimulai'). ' dan berakhir pada '.$request->post('berakhir'),'redirect'=>'/investor/dashboard/janjitemu?page=1','user_id'=>$investor->first()->id,'waktu'=>now()]);

       $request->session()->flash('success','Janji temu berhasil di request');
      return back();
    }

    public function tambah_janji_temu_view(Request $request){
        $limitUMKM = $request->get('limitUMKM') ? $request->get('limitUMKM') : 10;
            $umkm_all = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('roles','roles.user_id','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('users.accepted',true)
                         ->where('roles.number','=',2)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->limit( $limitUMKM )->get();
          $limitInv = $request->get('limitInv') ? $request->get('limitInv') : 10;
          $investor_all = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('roles','roles.user_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->where('accepted',true)
            ->where('roles.number','=',3)
            ->orderBy('profil.nama_lengkap','asc')
            ->limit($limitInv)
            ->get();
        $countUMKM = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',2)->get()->count();
        $countInvestor = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',3)->get()->count();
        return Inertia::render('Dashboard/Tambah_janji_temu',['umkm_all'=>$umkm_all,
                                                       'investor_all'=>$investor_all,
                                                       'countUMKM'=>$countUMKM,
                                                       'countInvestor'=>$countInvestor]);
    }

       public function edit_janji_temu_view(Request $request,$slug){
        $limitUMKM = $request->get('limitUMKM') ? $request->get('limitUMKM') : 10;
            $umkm_all = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('roles','roles.user_id','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('users.accepted',true)
                         ->where('roles.number','=',2)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->limit( $limitUMKM )->get();
          $limitInv = $request->get('limitInv') ? $request->get('limitInv') : 10;
          $investor_all = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('roles','roles.user_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->where('accepted',true)
            ->where('roles.number','=',3)
            ->orderBy('profil.nama_lengkap','asc')
            ->limit($limitInv)
            ->get();
        $countUMKM = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',2)->get()->count();
        $countInvestor = DB::table('users')->join('roles','roles.user_id','=','users.id')->where('roles.number','=',3)->get()->count();
        $janjitemu = Janjitemu::where('id','=',$slug)->first();

        return Inertia::render('Dashboard/edit_janji_temu_view',['umkm_all'=>$umkm_all,
                                                       'investor_all'=>$investor_all,
                                                       'countUMKM'=>$countUMKM,
                                                       'countInvestor'=>$countInvestor,
                                                        'janjitemu'=>$janjitemu]);
    }

    public function edit(Request $request)
    {
             $rules = [
            'lokasi' => 'required|max:100',
            'dimulai' => 'required',
            'umkm'=>'required',
            'investor'=>'required',
            'berakhir' =>'required',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $umkm = $request->post('umkm');
      $investor = $request->post('investor');
      $Janjitemu=Janjitemu::where('id','=',$request->post('janji_temu_id'))->first();
      $Janjitemu->update(['lokasi' => $request->post('lokasi'),
                                    'umkm_id' => $umkm,
                                    'investor'=>$investor,
                                    'waktu'=> $request->post('dimulai'),
                                    'berakhir'=>$request->post('berakhir'),
                                    'investor_id'=>$investor]);
      $request->session()->flash('success','Janji temu berhasil di request');
      $investor = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$investor)->first();
      $umkm = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$umkm)->first();
      Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Anda diundang untuk janji temu dengan investor '.$investor->profil->nama_lengkap.' dilokasi '.$request->post('lokasi').' dimulai pada '.$request->post('dimulai'). ' dan berakhir pada '.$request->post('berakhir'),'redirect'=>'/umkm/dashboard/janjitemu?page=1','user_id'=>$umkm->id,'waktu'=>now()]);
     $invNotif = $investor->notifikasi;
     $investor->update(['notifikasi'=>$invNotif+1]);
     $umkmNotif = $umkm->notifikasi;
     $umkm->update(['notifikasi'=>$umkmNotif+1]);
      Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Anda diundang untuk janji temu dengan UMKM '.$umkm->profil->nama_lengkap.' dilokasi '.$request->post('lokasi').' dimulai pada '.$request->post('dimulai'). ' dan berakhir pada '.$request->post('berakhir'),'redirect'=>'/investor/dashboard/janjitemu?page=1','user_id'=>$investor->id,'waktu'=>now()]);

      return back();
    }
   

      public function delete(Request $request){
        $data = Janjitemu::where('id','=',$request->post('id'))->first();
          $investor = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$data->investor_id)->first();
            $umkm = User::with('profil:id,nama_lengkap,user_id')->select('id','notifikasi')->where('id','=',$data->umkm_id)->first();
          Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Undangan anda untuk janji temu dengan investor '.$investor->profil->nama_lengkap.' dilokasi '.$data->lokasi.' dimulai pada '.$data->dimulai. ' dan berakhir pada '.$data->berakhir.' sudah selesai','redirect'=>'/umkm/dashboard/janjitemu?page=1','user_id'=>$umkm->id,'waktu'=>now()]);
         $invNotif = $investor->notifikasi;
         $investor->update(['notifikasi'=>$invNotif+1]);
         $umkmNotif = $umkm->notifikasi;
         $umkm->update(['notifikasi'=>$umkmNotif+1]);
       Notifikasi::create(['nama'=>'undangan janji temu','pesan'=>'Undangan anda untuk janji temu dengan UMKM '.$umkm->profil->nama_lengkap.' dilokasi '.$data->lokasi.' dimulai pada '.$data->dimulai. ' dan berakhir pada '.$data->berakhir.' sudah selesai','redirect'=>'/investor/dashboard/janjitemu?page=1','user_id'=>$investor->id,'waktu'=>now()]);

        $data->delete();
        $request->session()->flash('success','Janji temu berhasil dihapus');
        return back();
    }

     public function changeState(Request $request){;
        $data = Janjitemu::where('id','=',$request->post('id'))->update(['status'=>$request->post('update')]);
        $request->session()->flash('success','Janji temu berhasil diupdate');
        return back();
    }

    


}
